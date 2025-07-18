<?php

namespace App\Http\Requests\Academics;

use Illuminate\Foundation\Http\FormRequest;

class ProgramTypeDepartmentRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create program-types', 'edit program-types'])) {
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
      "id" => ['required', 'exists:program_types,id'],
      "department_vertical_ids" => ['required', 'array'],
      "department_vertical_ids.*" => ['required', 'distinct', 'exists:department_vertical,id'],
    ];
  }
}
