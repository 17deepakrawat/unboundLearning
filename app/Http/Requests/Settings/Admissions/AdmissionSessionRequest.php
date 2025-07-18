<?php

namespace App\Http\Requests\Settings\Admissions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdmissionSessionRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create admission-sessions', 'edit admission-sessions'])) {
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
      'vertical_id' => ['required', 'exists:verticals,id'],
      'month' => $this->getMethod() == 'POST' ? ['required', 'integer', 'between:1,12', Rule::unique('admission_sessions')->where(function ($query) {
        return $query
          ->where('month', $this->input('month'))
          ->where('year', $this->input('year'))
          ->where('vertical_id', $this->input('vertical_id'));
      })] : ['required', 'integer', 'between:1,12', Rule::unique('admission_sessions')->where(function ($query) use ($id) {
        return $query
          ->where('month', $this->input('month'))
          ->where('year', $this->input('year'))
          ->where('vertical_id', $this->input('vertical_id'))
          ->where('id', '!=', $id);
      })],
      'year' => ['required', 'integer'],
      'admission_type_ids' => ['required', 'array'],
      'admission_type_ids.*' => ['required', 'integer', 'distinct', 'exists:admission_types,id,vertical_id,' . $this->vertical_id],
      'scheme_ids' => ['required', 'array'],
      'start_dates' => ['required', 'array']
    ];
  }
}
