<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhoisLookupRequest extends FormRequest
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
            'domain' => 'required|string|regex:/^([a-z0-9-]+\.)+[a-z]{2,}$/i',
        ];
    }
}
