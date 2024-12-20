<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamCreateRequest extends FormRequest
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
            'conference' => 'nullable|string|max:100',
            'division' => 'nullable|string|max:100',
            'city' => 'required|string|max:100',
            'name' => 'required|string|max:100',
            'full_name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:5',
        ];

    }
}
