<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
          'name' => 'required',
          'lastname'=>'required',
          'email'=>'required|email|unique:users,email,'.$this->users->id,
          'password' => 'same:confirm-password',
          'roles' => 'required'
        ];
    }
}
