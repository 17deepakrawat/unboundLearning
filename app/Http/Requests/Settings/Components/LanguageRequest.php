<?php

namespace App\Http\Requests\Settings\Components;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create languages', 'edit languages'])) {
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
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:languages,name'] : ['required', 'string', 'unique:languages,name,' . $this->id],
      'locale' => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:languages,locale'] : ['required', 'string', 'unique:languages,locale,' . $this->id],
    ];
  }
}
