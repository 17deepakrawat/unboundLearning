<?php

namespace App\Http\Requests\Settings\Leads;

use Illuminate\Foundation\Http\FormRequest;

class SubStageRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create sub-stages', 'edit sub-stages'])) {
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
      'stage_id' => ['required', 'exists:stages,id'],
      'name' => $this->getMethod() == 'POST' ? ['required', 'string', 'unique:sub_stages,name,NULL,id,stage_id,' . $this->stage_id] : ['required', 'string', 'unique:sub_stages,name,except,id' . $this->id, 'unique:sub_stages,name,except,stage_id' . $this->stage_id],
    ];
  }
}
