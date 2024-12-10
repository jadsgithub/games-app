<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamUpdateRequest extends FormRequest
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
            'conference' => 'sometimes|nullable|string|max:100',
            'division' => 'sometimes|nullable|string|max:100',
            'city' => 'sometimes|nullable|string|max:100',
            'name' => 'sometimes|nullable|string|max:100',
            'full_name' => 'sometimes|nullable|string|max:255',
            'abbreviation' => 'sometimes|nullable|string|max:5',
        ];

    }
}
