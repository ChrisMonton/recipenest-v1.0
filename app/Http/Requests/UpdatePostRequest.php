<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        // Source: https://laravel.com/docs/11.x/validation#creating-form-requests
        return [
            'category' => 'required|string|min:2|max:100',
            'title' => 'required|string|min:2|max:255',
            'short_description' => 'required|string|min:2',
            'full_description' => 'required|string|min:2',
            'ingredients' => 'required|string|min:2',
            'instructions' => 'required|string|min:2',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:20480',
            'total_time' => 'required|integer|max:60',
            'total_time_unit' => 'required|string|min:2|max:255',
            'featured' => 'sometimes|string|min:1|max:10',
            'public' => 'sometimes|string|min:1|max:10',
        ];
    }
}
