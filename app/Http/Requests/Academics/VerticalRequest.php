<?php

namespace App\Http\Requests\Academics;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerticalRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create verticals', 'edit verticals'])) {
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
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', Rule::unique('verticals')->where(function ($query) {
        return $query
          ->where('name', $this->input('name'))
          ->where('vertical_name', $this->input('vertical_name'));
      })] : ['required', 'string', Rule::unique('verticals')->where(function ($query) use ($id) {
        return $query
          ->where('name', $this->input('name'))
          ->where('vertical_name', $this->input('vertical_name'))
          ->where('id', '!=', $id);
      })],
      'short_name' => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:verticals,short_name'] : ['required', 'string', 'unique:verticals,short_name,' . $this->id . ',id'],
      'vertical_name' => ['required', 'string'],
      'for_website' => ['required', 'boolean'],
      'for_panel' => ['required', 'boolean'],
      'logo' => $this->getMethod() == 'POST' ? ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:200'] : ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:200'],
    ];
  }
}
