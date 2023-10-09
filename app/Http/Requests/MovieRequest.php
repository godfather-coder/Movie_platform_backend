<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
        $rule = [
            'image' => 'required|mimes:png,jpg,jpeg'
        ];
        foreach (config('translatable.locales') as $locale) {
            $rule["$locale.title"] = 'required|string|max:255';
            $rule["$locale.description"] = 'required|string';
        }

        return $rule;
    }
}