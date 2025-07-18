<?php

namespace App\Http\Requests\Settings\Admissions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeeStructureRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create fee-structures', 'edit fee-structures'])) {
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
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', Rule::unique('fee_structures')->where(function ($query) {
        return $query
          ->where('name', $this->input('name'))
          ->where('vertical_id', $this->input('vertical_id'));
      })] : ['required', 'string', Rule::unique('fee_structures')->where(function ($query) use ($id) {
        return $query
          ->where('name', $this->input('name'))
          ->where('vertical_id', $this->input('vertical_id'))
          ->where('id', '!=', $id);
      })],
      'applicable_on' => ['required', 'string'],
      'has_sharing' => ['boolean'],
      'is_constant' => ['boolean']
    ];
  }
}
