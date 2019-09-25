<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
          'name'=>'required|unique:products,name',
          'description'=>'required',
           'image_path'=>'required',
          'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'category'=>'required',
          'subcategories'=>'required',
          'colour'=>'required',
          'quantity'=>'required|numeric',
        ];
    }
}
