<?php

namespace App\Http\Requests\UpdateRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city'                  => 'nullable|string',
            'street'                => 'nullable|string',
            'zipcode'               => 'nullable|string',
            'qualification'         => 'required|string',
            'qualification_short'   => 'required|string',
            'option'                => 'nullable|string',
            'option_short'          => 'nullable|string',
            'image'                 => 'nullable|string',
            'name'                  => 'required|string',
            'url'                   => 'nullable|string',
            'start_date'            => 'required|date',
            'end_date'              => 'nullable|date',
            'job_title'             => 'required|string',
            'contract'              => 'nullable|string',
            'company'               => 'nullable|integer',
        ];
    }
}
