<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OurTeamUpdateRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'max:255'],
            'name' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'fb' => ['max:255', 'nullable', 'url'],
            'in' => ['max:255', 'nullable', 'url'],
            'x' => ['max:255', 'nullable', 'url'],
            'web' => ['max:255', 'nullable', 'url'],
            'show_at_home' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ];
    }
}
