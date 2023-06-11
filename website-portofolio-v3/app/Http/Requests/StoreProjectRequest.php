<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'skill_id' => ['required', 'exists:skills,id'],
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:1024'],
            'project_url' => ['required', 'url', 'max:255'],
        ];
    }
}
