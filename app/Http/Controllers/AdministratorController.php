<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    public function login(Request $data) {
        if ($data->isMethod('POST')) {
            $adm = $data->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if (Auth::attempt($adm)) {
                return redirect()->intended('adm.movie.list');
            } else {
                return redirect()->route('adm.login')->with('err', 'Something went wrong!');
            }
        }
        return view('login');
    }

    public function register(Request $data) {
        if($data->isMethod('POST')) {
            $adm = $data->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $adm['password'] = Hash::make($adm['password']);
            Administrator::create($adm);
            return redirect()->route('adm.movie.list');
        }
        return view('register');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('adm.movie.list');
    }
}
