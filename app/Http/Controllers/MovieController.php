<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DB;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            Movie::create([...$newData, 'img' => $path]);
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
                $path = Storage::putFile('covers', $data->file('img'));
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

    public function listADM(Request $filter)
    {
        if ($filter->isMethod('POST')) {
            $validFilter = $filter->validate([
                'year' => 'numeric',
                'category_id' => 'numeric',
            ]);
            $finalFilter = [];
            $year = '';
            $cID = '';

            isset($validFilter['year']) ? $year = $validFilter['year'] : "";
            isset($validFilter['category_id']) ? $cID = $validFilter['category_id'] : "";

            if ($year !== '') {
                $finalFilter[] = ['year', 'LIKE', "%{$year}%"];
            }
            if ($cID !== '') {
                $finalFilter[] = ['category_id', '=', $cID];
            }
            $movies = Movie::where($finalFilter);
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
}
