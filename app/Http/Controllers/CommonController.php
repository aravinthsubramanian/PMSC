<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route('admins.dashboard'))->with('success', 'logged in successfully...');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route('users.dashboard'))->with('success', 'logged in successfully...');
        }

        return back()->with('error', 'Invalid Username or Password...');
    }
}
