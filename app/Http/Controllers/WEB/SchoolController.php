<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use App\Models\Image;
use App\Models\School;
use Illuminate\View\View;
use App\Helpers\Serializer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\SchoolResource;
use App\Http\Requests\StoreRequests\StoreSchoolRequest;
use App\Http\Requests\UpdateRequests\UpdateSchoolRequest;

class SchoolController extends Controller
{
    public function index() : View
    {
        $schools = School::all();

        return view('school.index', compact('schools'));
    }

    public function store() : View
    {
        return view('school.store');
    }

    public function create(StoreSchoolRequest $request) : RedirectResponse
    {
        $imageExist = Image::where('id', $request->image_id)->first();
        if ($imageExist) {
            $image = $imageExist->id;
        } else {
            $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);
        }

        try {
            School::create([
                'slug'          => Str::slug($request->name),
                'city'          => $request->city,
                'street'        => $request->street,
                'zipcode'       => $request->zipcode,
                'country'       => $request->country,
                'name'          => $request->name,
                'url'           => $request->url,
                'description'   => $request->description,
                'image_id'      => $image,
            ]);

            $status = "success";
            $message = "School created successfully";
        } catch (\Exception $e) {
            $status = "error";
            $message = "An error occurred while creating the school : " . $e->getMessage();
        }

        return redirect()->route('school.index')->with($status, $message);
    }

    public function createAsync(StoreSchoolRequest $request) : JsonResponse
    {
        $imageExist = Image::where('id', $request->image_id)->first();
        if ($imageExist) {
            $image = $imageExist->id;
        } else {
            $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);
        }

        try {
            $school = School::create([
                'slug'          => Str::slug($request->name),
                'city'          => $request->city,
                'street'        => $request->street,
                'zipcode'       => $request->zipcode,
                'country'       => $request->country,
                'name'          => $request->name,
                'url'           => $request->url,
                'description'   => $request->description,
                'image_id'      => $image,
            ]);

            $return = Serializer::success(new SchoolResource($school), "School created successfully",JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            $return = Serializer::error("An error occurred while creating the school", [], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $return;
    }

    public function edit(string $slug) : View
    {
        $school = School::where('slug', $slug)->first();
        return view('school.edit', compact('school'));
    }

    public function update(UpdateSchoolRequest $request, string $slug) : RedirectResponse
    {
        $school = School::where('slug', $slug)->first();
        $imageExist = Image::where('id', $request->image_id)->first();
        if ($imageExist) {
            $image = $imageExist->id;
        } else {
            $oldImage = Image::findOrfail($school->image_id);
            $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);
        }

        try {
            $school->update([
                'slug'          => Str::slug($request->name),
                'city'          => $request->city,
                'street'        => $request->street,
                'zipcode'       => $request->zipcode,
                'country'       => $request->country,
                'name'          => $request->name,
                'url'           => $request->url,
                'description'   => $request->description,
                'image_id'      => $image,
            ]);
            app("App\Http\Controllers\WEB\ImageController")->delete($oldImage);

            $status = "success";
            $message = "School updated successfully";
        } catch (\Exception $e) {
            $status = "error";
            $message = "An error occurred while updating the school : " . $e->getMessage();
        }

        return redirect()->route('school.index');
    }

    public function delete(string $slug) : JsonResponse
    {
        $school = School::where('slug', $slug)->first();
        $image = Image::find($school->image_id);

        $school->experiences()->delete();
        $school->delete();
        if ($image) {
            app("App\Http\Controllers\WEB\ImageController")->delete($image);
        }

        return response()->json("School deleted successfully");
    }
}
