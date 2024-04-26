<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function index() : View
    {
        return view('login');
    }

    public function login(LoginRequest $request) : RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            return redirect()->route('homepage');
        }
        return redirect('/')->with('error', 'Invalid credentials');
    }

    public function logout() : RedirectResponse
    {
        auth()->logout();
        return redirect('/');
    }
}
