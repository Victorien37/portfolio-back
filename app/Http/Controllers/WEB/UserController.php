<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateRequests\UpdateAboutRequest;
use App\Models\Image;

class UserController extends Controller
{
    public function index() : View
    {
        return view('about.index');
    }

    public function update(UpdateAboutRequest $request) : RedirectResponse
    {
        $status     = "error";
        $message    = "Une erreur s'est produite lors de la mise à jour du profil";

        $imageExist = Image::where('id', $request->image)->first();

        if (!$imageExist) {
            $image = app('App\Http\Controllers\WEB\ImageController')->create($request->image);
        } else {
            $image = $request->image;
        }

        auth()->user()->update([
            "image_id"      => $image,
            "description"   => $request->description,
        ]);

        $status     = "success";
        $message    = "Profil mis à jour avec succès";

        return redirect()->route('about')->with($status, $message);
    }
}
