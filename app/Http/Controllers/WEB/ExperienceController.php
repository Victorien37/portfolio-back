<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use App\Models\Image;
use App\Models\School;
use App\Models\Company;
use Illuminate\View\View;
use App\Models\Experience;
use App\Helpers\Serializer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRequests\StoreCareerRequest;
use App\Http\Requests\UpdateRequests\UpdateCareerRequest;
use App\Http\Requests\StoreRequests\StoreExperienceRequest;
use App\Http\Requests\UpdateRequests\UpdateExperienceRequest;

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

    public function createExperience(StoreExperienceRequest $request) : RedirectResponse
    {
        try {
            Experience::create([
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'contract'      => $request->contract,
                'job_title'     => $request->job_title,
                'linked_job'    => isset($request->linked_job),
                'company_id'    => $request->company,
            ]);

            $status = 'success';
            $message = "The experience has been successfully created.";
        } catch (Exception $e) {
            $status     = 'error';
            $message    = "An error occurred while creating the experience.";
        }

        return redirect()->route('experience.index')->with($status, $message);
    }

    public function editExperience(Experience $experience) : View
    {
        $companies = Company::all();
        $contracts = ['CDD', 'CDI', 'Stage', 'Freelance'];
        return view('experience.edit', compact('experience', 'companies', 'contracts'));
    }

    public function updateExperience(Experience $experience, UpdateExperienceRequest $request) : RedirectResponse
    {
        try {
            $experience->update([
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'contract'      => $request->contract,
                'job_title'     => $request->job_title,
                'linked_job'    => isset($request->linked_job),
                'company_id'    => $request->company,
            ]);

            $status = 'success';
            $message = "The experience has been successfully updated.";
        } catch (Exception $e) {
            $status     = 'error';
            $message    = "An error occurred while updating the experience.";
        }

        return redirect()->route('experience.index')->with($status, $message);
    }

    public function deleteExperience(Experience $experience) : JsonResponse
    {
        try {
            $experience->delete();
            $message = "The experience has been successfully deleted.";
        } catch (Exception $e) {
            $message = "An error occurred while deleting the experience.";
        }

        return response()->json($message);
    }

    public function career() : View
    {
        $experiences = Experience::whereNotNull('school_id')->get();
        return view('career.index', compact('experiences'));
    }

    public function storeCareer() : View
    {
        $companies  = Company::all();
        $schools    = School::all();
        return view('career.store', compact('companies', 'schools'));
    }

    public function createCareer(StoreCareerRequest $request) : RedirectResponse
    {
        try {
            $school = School::findOrfail($request->school);

            if (isset($request->contract) && isset($request->company)) {
                $company = Company::findOrfail($request->company)->id;
            } else {
                $company = null;
            }

            Experience::create([
                'start_date'            => $request->start_date,
                'end_date'              => $request->end_date,
                'contract'              => isset($request->contract) ? 'Alternance' : null,
                'job_title'             => $request->job_title,
                'linked_job'            => isset($request->linked_job),
                'company_id'            => $company,
                'school_id'             => $school->id,
                'qualification'         => $request->qualification,
                'qualification_short'   => $request->qualification_short,
                'option'                => $request->option,
                'option_short'          => $request->option_short,
            ]);

            $status = 'success';
            $message = "The career step has been successfully created.";
        } catch (Exception $e) {
            $status     = 'error';
            $message    = "An error occurred while creating the career step.";
        }

        return redirect()->route('career.index')->with($status, $message);
    }

    public function editCareer(Experience $experience) : View
    {
        $companies  = Company::all();
        $schools    = School::all();
        return view('career.edit', compact('experience', 'companies', 'schools'));
    }

    public function updateCareer(Experience $experience, UpdateCareerRequest $request) : RedirectResponse
    {
        try {
            $experience->update([
                'start_date'            => $request->start_date,
                'end_date'              => $request->end_date,
                'contract'              => isset($request->contract) ? 'Alternance' : null,
                'job_title'             => $request->job_title,
                'linked_job'            => isset($request->linked_job),
                'company_id'            => $request->company,
                'school_id'             => $request->school,
                'qualification'         => $request->qualification,
                'qualification_short'   => $request->qualification_short,
                'option'                => $request->option,
                'option_short'          => $request->option_short,
            ]);

            $status = 'success';
            $message = "The career step has been successfully updated.";
        } catch (Exception $e) {
            $status     = 'error';
            $message    = "An error occurred while updating the career step.";
        }

        return redirect()->route('career.index')->with($status, $message);
    }

    public function deleteCareer(Experience $experience) : JsonResponse
    {
        try {
            $school = School::findOrfail($experience->school->id);

            $experience->update([
                'school_id' => null,
            ]);

            $school->delete();
            $experience->delete();

            $return = Serializer::success("The career step has been successfully deleted.", [], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            $return = Serializer::error("An error occurred while deleting the career step.", [], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $return;
    }
}
