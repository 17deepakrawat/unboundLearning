<?php

namespace App\Http\Requests\Academics;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create departments', 'edit departments'])) {
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
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:departments,name'] : ['required', 'string', 'unique:departments,name,' . $this->id],
      'language_ids' => ['required', 'array'],
      'language_ids.*' => ['required', 'distinct', 'exists:languages,id'],
      'for_website' => ['required', 'boolean']
    ];
  }
}
