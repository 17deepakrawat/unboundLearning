<?php

namespace App\Http\Requests\Academics;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecializationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create specializations', 'edit specializations'])) {
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
    $id = $this->id;
    return [
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', Rule::unique('specializations')->where(function ($query) {
        return $query
          ->where('name', $this->input('name'))
          ->where('department_id', $this->input('department_id'))
        ->where('program_id', $this->input('program_id'))
        ->where('program_type_id', $this->input('program_type_id'))
        ->where('mode_id', $this->input('mode_id'));
      })] : ['required', 'string', Rule::unique('specializations')->where(function ($query) use ($id) {
        return $query
          ->where('name', $this->input('name'))
          ->where('department_id', $this->input('department_id'))
          ->where('program_id', $this->input('program_id'))
          ->where('program_id', $this->input('program_id'))
          ->where('program_type_id', $this->input('program_type_id'))
          ->where('mode_id', $this->input('mode_id'))
          ->where('id', '!=', $id);
      })],
      'department_id' => ['required', 'exists:departments,id'],
      'program_id' => ['required', 'exists:programs,id'],
      'program_type_id' => ['required', 'exists:program_types,id'],
      'mode_id' => ['required', 'exists:modes,id'],
      'min_duration' => ['required', 'integer', 'min:1'],
      'max_duration' => ['required', 'integer', 'min:1'],
      "required_eligibility_criterion_ids" => ['array'],
      "required_eligibility_criterion_ids.*" => ['distinct', 'exists:eligibility_criteria,id'],
      "optional_eligibility_criterion_ids" => ['array'],
      "optional_eligibility_criterion_ids.*" => ['distinct', 'exists:eligibility_criteria,id'],
      "for_website" => ['required', 'boolean']
    ];
  }
}
