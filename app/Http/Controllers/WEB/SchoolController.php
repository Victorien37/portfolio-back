<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolController extends Controller
{
    public function index() : View
    {
        return view('school.index');
    }
}
