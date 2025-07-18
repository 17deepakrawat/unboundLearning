<?php

namespace App\Http\Requests\Academics;

use Illuminate\Foundation\Http\FormRequest;

class ProgramTypeRequest extends FormRequest
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
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:program_types,name'] : ['required', 'string', 'unique:program_types,name,' . $this->id],
      'department_ids' => ['required', 'array'],
      'department_ids.*' => ['required', 'distinct', 'exists:departments,id'],
      'for_website' => ['required', 'boolean']
    ];
  }
}
