<?php

namespace App\Http\Requests\Academics;

use Illuminate\Foundation\Http\FormRequest;

class ProgramProgramTypeDepartmentVerticalRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create programs', 'edit programs'])) {
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
      "id" => ['required', 'exists:programs,id'],
      "program_type_department_vertical_ids" => ['required', 'array'],
      "program_type_department_vertical_ids.*" => ['required', 'distinct', 'exists:program_type_department_vertical,id']
    ];
  }
}
