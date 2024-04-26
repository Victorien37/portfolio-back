<?php

namespace App\Http\Requests\UpdateRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomepageRequest extends FormRequest
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
            'image'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'messages'  => 'required|string',
            'github'    => 'required|string',
            'gitlab'    => 'required|string',
            'linkedin'  => 'required|string',
        ];
    }
}
