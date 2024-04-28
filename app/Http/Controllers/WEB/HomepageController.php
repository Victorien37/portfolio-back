<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateRequests\UpdateHomepageRequest;
use App\Models\Homepage;

class HomepageController extends Controller
{
    public function index()
    {
        $homepage = Homepage::first();

        return view('homepage.index', compact('homepage'));
    }

    public function update(UpdateHomepageRequest $request) : RedirectResponse
    {
        $homepage = Homepage::first();

        $image = app('App\Http\Controllers\WEB\ImageController')->create($request->image);

        if ($image) {
            $homepage->update([
                'image_id'  => $image,
                'messages'  => $request->messages,
                'github'    => $request->github,
                'gitlab'    => $request->gitlab,
                'linkedin'  => $request->linkedin,
            ]);
        }

        return redirect()->route('homepage');
    }
}
