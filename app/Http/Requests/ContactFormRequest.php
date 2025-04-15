<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The URI that users should be redirected to if validation fails.
     *
     * @var string
     */
    public function failedValidation(Validator $validator)
    {

        return redirect()->route('authors.recipes.index');
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
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ];
    }
}
