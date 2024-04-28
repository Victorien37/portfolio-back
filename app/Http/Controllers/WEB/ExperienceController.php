<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Experience;
use App\Models\Company;

class ExperienceController extends Controller
{
    public function experience() : View
    {
        $experiences = Experience::whereNull('school_id')->get();
        return view('experience.index', compact('experiences'));
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
}
