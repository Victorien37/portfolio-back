<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use App\Models\Image;
use App\Models\School;
use App\Models\Company;
use Illuminate\View\View;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRequests\StoreCareerRequest;
use App\Http\Requests\UpdateRequests\UpdateCareerRequest;

class ExperienceController extends Controller
{
    public function experience() : View
    {
        $experiences = Experience::whereNull('school_id')->get();
        return view('experience.index', compact('experiences'));
    }

    public function storeExperience() : View
    {
        $companies = Company::all();
        $contracts = ['CDD', 'CDI', 'Stage', 'Freelance'];
        return view('experience.store', compact('companies', 'contracts'));
    }

    public function createExperience() : RedirectResponse
    {
        //
    }

    public function editExperience() : View
    {
        //
    }

    public function updateExperience() : RedirectResponse
    {
        //
    }

    public function deleteExperience() : JsonResponse
    {
        //
    }

    public function career() : View
    {
        $experiences = Experience::whereNotNull('school_id')->get();
        return view('career.index', compact('experiences'));
    }

    public function storeCareer() : View
    {
        $companies = Company::all();
        return view('career.store', compact('companies'));
    }

    public function createCareer(StoreCareerRequest $request) : RedirectResponse
    {
        $status = 'error';
        $message = "Une erreur est survenue lors de l'ajout de l'étape du parcours.";

        if ($request->image) {
            $imageExist = Image::where('id', $request->image)->first();

            if (!$imageExist) {
                $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);
            } else {
                $image = $imageExist->id;
            }
        }

        $school = School::create([
            'name'                  => $request->name,
            'city'                  => $request->city,
            'street'                => $request->street,
            'zipcode'               => $request->zipcode,
            'description'           => $request->description,
            'url'                   => $request->url,
            'image_id'              => $image ?? null,
            'qualification'         => $request->qualification,
            'qualification_short'   => $request->qualification_short,
            'option'                => $request->option,
            'option_short'          => $request->option_short,
        ]);

        if ($school) {
            $experience = Experience::create([
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'job_title'     => $request->job_title,
                'development'   => isset($request->development),
                'contract'      => (isset($request->contract) && isset($request->company)) ? 'Alternance' : null,
                'school_id'     => $school->id,
                'company_id'    => (isset($request->contract) && isset($request->company)) ? $request->company : null,
            ]);

            $status = 'success';
            $message = "L'étape du parcours a bien été ajoutée.";
        }

        return redirect()->route('career')->with($status, $message);
    }

    public function editCareer(Experience $experience) : View
    {
        $companies = Company::all();
        return view('career.edit', compact('experience', 'companies'));
    }

    public function updateCareer(Experience $experience, UpdateCareerRequest $request) : RedirectResponse
    {
        $status = 'error';
        $message = "Une erreur est survenue lors de la modification de l'étape du parcours.";

        if ($request->image) {
            $imageExist = Image::where('id', $request->image)->first();

            if (!$imageExist) {
                $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);
            } else {
                $image = $imageExist->id;
            }
        }

        $school = School::where('id', $experience->school->id)->first();

        $school->update([
            'name'                  => $request->name,
            'city'                  => $request->city,
            'street'                => $request->street,
            'zipcode'               => $request->zipcode,
            'description'           => $request->description,
            'url'                   => $request->url,
            'image_id'              => $image ?? null,
            'qualification'         => $request->qualification,
            'qualification_short'   => $request->qualification_short,
            'option'                => $request->option,
            'option_short'          => $request->option_short,
        ]);

        if ($school) {
            $experience->update([
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'job_title'     => $request->job_title,
                'development'   => isset($request->development),
                'contract'      => (isset($request->contract) && isset($request->company)) ? 'Alternance' : null,
                'company_id'    => (isset($request->contract) && isset($request->company)) ? $request->company : null,
            ]);

            $status = 'success';
            $message = "L'étape du parcours a bien été modifiée.";
        }

        return redirect()->route('career')->with($status, $message);
    }

    public function deleteCareer(Experience $experience) : JsonResponse
    {
        $school = $experience->school->id;

        $experience->update([
            'school_id' => null,
        ]);

        School::where('id', $school)->first()->delete();
        $experience->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => "L'étape du parcours a bien été supprimée.",
        ]);
    }
}
