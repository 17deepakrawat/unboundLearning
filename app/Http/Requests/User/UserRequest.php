<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    if ($this->user()->can(['create users', 'edit users'])) {
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
      'name' => ['required', 'string'],
      'avatar' => ['mimes:png,jpg,jpeg,gif', 'max:200'],
      'email' => $this->getMethod() == 'POST' ? ['required', 'email', 'unique:users,email'] : ['required', 'email', Rule::unique('users')->where(function ($query) use ($id) {
        return $query
          ->where('email', $this->input('email'))
          ->where('id', '!=', $id);
      })],
      'mobile' => $this->getMethod() == 'POST' ? ['required', 'unique:users,mobile'] : ['required', Rule::unique('users')->where(function ($query) use ($id) {
        return $query
          ->where('mobile', $this->input('mobile'))
          ->where('id', '!=', $id);
      })],
      'role_id' => ['required', 'exists:roles,id'],
      'password' => $this->getMethod() == 'POST' ? ['required', 'string', 'min:8'] : ['string'],
    ];
  }
}
