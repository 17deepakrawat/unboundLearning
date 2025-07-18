<?php

namespace App\Http\Requests\Settings\Leads;

use Illuminate\Foundation\Http\FormRequest;

class CustomFieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()->can(['create custom-fields', 'edit custom-fields'])) {
            return true;
          }
          return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:custom-fields,name'],
        ];
    }
}
