<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Undefined;

class MovieController extends Controller
{
    public function add(Request $data)
    {
        if ($data->isMethod('POST')) {
            $newData = $data->validate([
                'name' => 'required|min:2|max:70',
                'year' => 'required|numeric',
                'category_id' => 'required',
                'link' => 'required|min:6|max:300',
                'synopsis' => 'max:200',
                'img' => 'required|image',
            ]);
            $path = Storage::putFile('covers', $data->file('img'));
            preg_match(
                '/[\\?\\&]v=([^\\?\\&]+)/',
                $newData['link'],
                $link
            );
            Movie::create([...$newData, 'img' => $path, 'link' => $link[1],]);
            return redirect()->route('movie.list');
        } else {
            $categories = Category::all();
            return view('movie.add', [
                'categories' => $categories,
            ]);
        }
    }

    public function edit(Request $data, $id)
    {
        if ($data->isMethod('POST')) {
            $newData = $data->validate([
                'id' => 'required|numeric',
                'oldImg' => 'required|string',
                'name' => 'required|min:2|max:70',
                'year' => 'required|numeric',
                'category_id' => 'required',
                'link' => 'required|min:6|max:300',
                'synopsis' => 'max:200',
                'img' => 'image',
            ]);
            if (isset($newData['img'])) {
                $path = Storage::putFile('/public/covers', $data->file('img'));
                Storage::delete('oldImg');
            } else {
                $path = $newData['oldImg'];
            }
            unset($newData['oldImg']);

            Movie::where('id', '=', $newData['id'])->update([...$newData, 'img' => $path]);
            return redirect()->route('movie.list');
        } else {
            $categories = Category::all();
            $data = Movie::find($id);
            return view('movie.edit', [
                'categories' => $categories,
                'data' => $data,
            ]);
        }
    }

    public function delete($id)
    {
        $movie = Movie::find($id);
        $test = File::delete(public_path($movie->img));
        Movie::where('id', '=', $id)->delete();
        return redirect()->route('movie.list');
    }

    public function list(Request $filter)
    {
        if ($filter->isMethod('POST')) {
            $finalFilter = [];
            $year = '';
            $cID = '';

            isset($filter['year']) ? $year = $filter['year'] : "";
            isset($filter['category_id']) ? $cID = $filter['category_id'] : "";

            if ($year !== '') {
                $finalFilter[] = ['year', 'LIKE', "%{$year}%"];
            }
            if ($cID !== '') {
                $finalFilter[] = ['category_id', '=', strval($cID)];
            }
            $movies = Movie::where($finalFilter)->paginate();
            $records = Movie::where($finalFilter)->count();
            $categories = Category::all();
            return view('movie.list', [
                'mov' => $movies,
                'cat' => $categories,
                'rec' => $records,
            ]);
        } else {
            $categories = Category::all();
            $movies = Movie::paginate();
            $records = Movie::all()->count();
            return view('movie.list', [
                'mov' => $movies,
                'cat' => $categories,
                'rec' => $records,
            ]);
        }
    }

    public function movieInfo($id)
    {
        $mov = Movie::find($id);
        $category = Category::find($mov->category_id);
        $categories = Category::all();
        $c = $category->name;
        return view('movie.view', [
            'mov' => $mov,
            'cat' => $categories,
            'sc' => $c,
        ]);
    }
}
