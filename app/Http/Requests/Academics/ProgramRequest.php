<?php

namespace App\Http\Requests\Academics;

use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
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
      "name" => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:programs,name'] : ['required', 'string', 'unique:programs,name,' . $this->id],
      "short_name" => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:programs,short_name'] : ['required', 'string', 'unique:programs,short_name,' . $this->id],
      "program_type_ids" => ['required', 'array'],
      "program_type_ids.*" => ['required', 'distinct', 'exists:program_types,id'],
      "department_ids" => ['required', 'array'],
      "department_ids.*" => ['required', 'distinct', 'exists:departments,id'],
      "required_eligibility_criterion_ids" => ['required', 'array'],
      "required_eligibility_criterion_ids.*" => ['required', 'distinct', 'exists:eligibility_criteria,id'],
      "optional_eligibility_criterion_ids" => ['array'],
      "optional_eligibility_criterion_ids.*" => ['distinct', 'exists:eligibility_criteria,id'],
      "for_website" => ['required', 'boolean'],
      "duration" => $this->for_website == true ? ['required', 'string'] : ['string']
    ];
  }
}
