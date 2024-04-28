<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Image;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function create(string $base64) : ?int
    {
        $return = null;
        $img = InterventionImage::make(base64_decode($base64))->encode('jpg', 100);

        $image_name = uniqid();
        $image_url = '/images/' . $image_name . '.jpg';
        $image = Image::create([
            'alt' => $image_name,
            'url' => $image_url,
        ]);

        if ($image) {
            Storage::disk('public')->put($image_url, $img);

            $return = $image->id;
        }

        return $return;
    }
}
