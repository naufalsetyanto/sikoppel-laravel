<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register/index',[
            'title' => 'Register'
        ]);
    }

    public function daftar(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        // $request->session()->flash('success', 'Registrasi Berhasil, Silahkan Login!!');

        return redirect('/login')->with('success', 'Registrasi Berhasil, Silahkan Login!!');
    }
}
