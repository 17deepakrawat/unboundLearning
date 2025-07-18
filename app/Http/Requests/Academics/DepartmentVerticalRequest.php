<?php

namespace App\Http\Requests\Academics;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentVerticalRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['edit departments'])) {
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
      'id' => ['required', 'exists:departments,id'],
      'vertical_ids' => ['required', 'array'],
      'vertical_ids.*' => ['required', 'exists:verticals,id', 'distinct'],
    ];
  }
}
