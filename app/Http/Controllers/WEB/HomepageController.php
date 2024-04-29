<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateRequests\UpdateHomepageRequest;
use App\Models\Homepage;
use App\Models\Image;

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
        $status     = 'error';
        $message    = "Erreur lors de la mise à jour de la page d'accueil.";

        if ($homepage) {
            $imageExist = Image::where('id', $request->image)->first();

            if (!$imageExist) {
                $image = app('App\Http\Controllers\WEB\ImageController')->create($request->image);
            } else {
                $image = $request->image;
            }


            if ($image) {
                $homepage->update([
                    'image_id'  => $image,
                    'messages'  => $request->messages,
                    'github'    => $request->github,
                    'gitlab'    => $request->gitlab,
                    'linkedin'  => $request->linkedin,
                ]);

                $status = 'success';
                $message = "La page d'accueil a bien été mise à jour.";
            }
        }

        return redirect()->route('homepage')->with($status, $message);
    }
}
