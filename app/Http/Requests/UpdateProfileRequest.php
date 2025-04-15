<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:100',
            'profile' => 'sometimes|image|mimes:png,jpg,jpeg,gif,webp|max:20480',
            'short_description' => 'required|string|min:2|max:200',
            'full_description' => 'required|string|min:2',
            'address' => 'sometimes|string|min:2|max:200',
            'phone' => 'sometimes|string|max:15',
            'birthday' => 'required|date|before_or_equal:' . Carbon::today()->toDateString(),
            'social_facebook' => 'sometimes|string|max:200',
            'social_x' => 'sometimes|string|max:200',
            'social_instagram' => 'sometimes|string|max:200',
        ];
    }
}
