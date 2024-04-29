<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Http\Requests\StoreRequests\StoreLoginRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() : View
    {
        $userExist = User::first() === null ? false : true;
        return view('login', compact('userExist'));
    }

    public function create(StoreLoginRequest $request) : RedirectResponse
    {
        $user = User::create([
            'name'      => 'Admin',
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        auth()->login($user);

        return redirect()->route('homepage');
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
