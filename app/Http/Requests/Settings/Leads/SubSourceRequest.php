<?php

namespace App\Http\Requests\Settings\Leads;

use Illuminate\Foundation\Http\FormRequest;

class SubSourceRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create sub-sources', 'edit sub-sources'])) {
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
      'source_id' => ['required', 'exists:sources,id'],
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:sub_sources,name,NULL,id,source_id,' . $this->source_id] : ['required', 'string', 'unique:sub_sources,name,except,id' . $this->id, 'unique:sub_sources,name,except,source_id' . $this->source_id],
    ];
  }
}
