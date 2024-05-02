<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Exception;
use App\Models\Image;
use App\Models\Company;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRequests\StoreProjectRequest;
use App\Http\Requests\UpdateRequests\UpdateProjectRequest;

class ProjectController extends Controller
{

    public function index(string $slug) : View
    {
        $company = Company::where('slug', $slug)->first();
        $projects = $company->projects;
        return view('company.project.index', compact('projects', 'company'));
    }

    public function store(string $slug) : View
    {
        $company = Company::where('slug', $slug)->first();
        return view('company.project.store', compact('company'));
    }

    public function create(StoreProjectRequest $request, string $slug) : RedirectResponse
    {
        $company = Company::where('slug', $slug)->first();
        try {
            $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);

            if ($image) {
                Project::create([
                    'slug'          => Str::slug($request->name),
                    'name'          => $request->name,
                    'start_date'    => $request->start_date,
                    'end_date'      => $request->end_date,
                    'description'   => $request->description,
                    'url'           => $request->url,
                    'url2'          => $request->url2,
                    'image_id'      => $image,
                    'company_id'    => $company->id,
                ]);

                $status = 'success';
                $message = "The project has been successfully created.";
            } else {
                $status     = 'error';
                $message    = "An error occurred while creating the project.";
            }

        } catch (Exception $e) {
            $status     = 'error';
            $message    = "An error occurred while creating the project.";
        }

        return redirect()->route('project.index', ['companySlug' => $company->slug])->with($status, $message);
    }

    public function edit(string $companySlug, string $projectSlug) : View
    {
        $company = Company::where('slug', $companySlug)->first();
        $project = Project::where('slug', $projectSlug)->first();
        return view('company.project.edit', compact('company', 'project'));
    }

    public function update(UpdateProjectRequest $request, string $companySlug, string $projectSlug) : RedirectResponse
    {
        $company = Company::where('slug', $companySlug)->first();
        $project = Project::where('slug', $projectSlug)->first();
        try {
            $imageExist = Image::find($project->image_id);
            $oldImage = null;

            if ($imageExist) {
                $image = $imageExist->id;
            } else {
                $oldImage = Image::find($project->image_id);
                $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);
            }

            if ($image) {
                $project->update([
                    'slug'          => Str::slug($request->name),
                    'name'          => $request->name,
                    'description'   => $request->description,
                    'start_date'    => $request->start_date,
                    'end_date'      => $request->end_date,
                    'url'           => $request->url,
                    'url2'          => $request->url2,
                    'image_id'      => $image,
                ]);

                if ($oldImage) {
                    $oldImage->delete();
                }

                $status = 'success';
                $message = "The project has been successfully updated.";
            } else {
                $status     = 'error';
                $message    = "An error occurred while updating the project.";
            }

        } catch (Exception $e) {
            $status     = 'error';
            $message    = "An error occurred while updating the project.";
        }

        return redirect()->route('project.index', $company->slug)->with($status, $message);
    }

    public function delete(string $companySlug, string $projectSlug) : JsonResponse
    {
        $project = Project::where('slug', $projectSlug)->first();
        try {
            $project->delete();
            $message = 'The project has been successfully deleted.';
        } catch (Exception $e) {
            $message = 'An error occurred while deleting the project.';
        }

        return response()->json($message);
    }

}
