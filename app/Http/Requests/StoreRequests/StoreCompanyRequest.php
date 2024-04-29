<?php

namespace App\Http\Requests\StoreRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name'          => "required|string",
            'description'   => "nullable|string",
            'city'          => "nullable|string",
            'street'        => "nullable|string",
            'zipcode'       => "nullable|string",
            'url'           => "nullable|string",
            'image'         => "nullable|string",
        ];
    }
}
