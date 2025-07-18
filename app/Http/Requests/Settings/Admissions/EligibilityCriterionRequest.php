<?php

namespace App\Http\Requests\Settings\Admissions;

use Illuminate\Foundation\Http\FormRequest;

class EligibilityCriterionRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create admission-types', 'edit admission-types'])) {
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
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:eligibility_criteria,name'] : ['required', 'string', 'unique:eligibility_criteria,name,except,id' . $this->id],
      'vertical_ids' => ['required', 'array'],
      'vertical_ids.*' => ['required', 'distinct', 'exists:verticals,id'],
    ];
  }
}
