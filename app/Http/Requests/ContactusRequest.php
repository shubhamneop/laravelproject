<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactusRequest extends FormRequest
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
          'name'=>'required',
          'contactno'=>'required|numeric|min:10',
          'email'=>'required|email',
          'subject'=>'required',
          'message'=>'required',
        ];
    }
}
