<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreRequests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\Image;
use App\Helpers\Serializer;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    public function create(StoreCompanyRequest $request) : JsonResponse
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

            $return = Serializer::success(new CompanyResource($company), "L'entrepise a bien été ajouté", JsonResponse::HTTP_CREATED);
        }

        return $return;
    }
}
