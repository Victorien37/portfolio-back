<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateRequests\UpdateHomepageRequest;

class HomepageController extends Controller
{
    public function index()
    {
        return view('homepage.index');
    }

    public function update(UpdateHomepageRequest $request) : RedirectResponse
    {
        dd($request->all());
    }
}
