<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreRequests\StoreCompanyRequest;
use App\Http\Requests\UpdateRequests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Image;
use App\Helpers\Serializer;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class CompanyController extends Controller
{
    public function index() : View
    {
        $companies = Company::all();

        return view('company.index', compact('companies'));
    }

    public function store() : View
    {
        return view('company.store');
    }

    public function create(StoreCompanyRequest $request) : RedirectResponse
    {
        $status     = "error";
        $message    = "An error has occurred while creating the company";

        $image      = app("App\Http\Controllers\WEB\ImageController")->create($request->image);

        if ($image) {
            Company::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'city'          => $request->city,
                'street'        => $request->street,
                'zipcode'       => $request->zipcode,
                'country'       => $request->country,
                'url'           => $request->url,
                'image_id'      => $image,
            ]);

            $message    = "The company has been created";
            $status     = "success";
        }

        return redirect()->route('company.index')->with($status, $message);
    }

    public function edit(Company $company) : View
    {
        return view('company.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company) : RedirectResponse
    {
        $status     = "error";
        $message    = "An error has occurred while updating the company";

        $imageExist = Image::where('id', $request->image)->first();

        if ($imageExist) {
            $image = $imageExist->id;
        } else {
            $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);

            $company->update([ 'image_id' => null ]);

            $company->image()->delete();
        }

        if ($image) {
            $company->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'city'          => $request->city,
                'street'        => $request->street,
                'zipcode'       => $request->zipcode,
                'country'       => $request->country,
                'url'           => $request->url,
                'image_id'      => $image,
            ]);

            $message    = "The company has been updated";
            $status     = "success";
        }

        return redirect()->route('company.index')->with($status, $message);
    }

    public function delete(Company $company) : JsonResponse
    {
        $image = Image::where('id', $company->image_id)->first();

        $company->delete();
        $image->delete();

        return response()->json("Company has been deleted");
    }

    public function createWithAxios(StoreCompanyRequest $request) : JsonResponse
    {
        $return = Serializer::error("Cette entreprise existe déjà", [], JsonResponse::HTTP_CONFLICT);
        $companyExist = Company::where('name', $request->name)->first();

        if (!$companyExist) {
            if ($request->image) {
                $imageExist = Image::where('id', $request->image)->first();

                if (!$imageExist) {
                    $image = app("App\Http\Controllers\WEB\ImageController")->create($request->image);
                } else {
                    $image = $imageExist->id;
                }
            }

            $company = Company::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'city'          => $request->city,
                'street'        => $request->street,
                'zipcode'       => $request->zipcode,
                'url'           => $request->url,
                'image_id'      => $image ?? null,
            ]);

            $return = Serializer::success(new CompanyResource($company), "Company was created succesfully", JsonResponse::HTTP_CREATED);
        }

        return $return;
    }
}
