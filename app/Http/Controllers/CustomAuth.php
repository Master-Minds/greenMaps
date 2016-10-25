<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class CustomAuth extends Controller
{
    public function login(Request $request)
    {
    	$username = $request->input('username');
    	$password = $request->input('password');

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended();
        }
    }
}
