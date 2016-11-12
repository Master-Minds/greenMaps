<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use DB;

use Illuminate\Support\Facades\Hash;

class CustomAuth extends Controller
{

    public function login(Request $request)
    {
    	$username = $request->input('username');
        $password = $request->input('password');

        $user = DB::table('users')
                    ->where('email', $username)
                    ->orWhere('username', $username)
                    ->first();

        if(!$user)
            return view('auth.login')->withErrors(["error" => 'Грешен потребител или парола!']);

        if(Hash::check($password, $user->password)){
            if (Auth::attempt(['username' => $user->username, 'password' => $password])) {
                return redirect()->intended();
            }
        }else{
            return view('auth.login')->withErrors(["error" => 'Грешен потребител или парола!']);
        }
    }
}