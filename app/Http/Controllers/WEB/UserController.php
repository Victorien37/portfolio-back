<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function about()
    {
        return view('about.index');
    }
}