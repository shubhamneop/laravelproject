<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
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
          'title'=>'required|unique:pages,title,'.$this->page->id,
          'slug'=>'required|unique:pages,slug,'.$this->page->id,
          'status'=>'required',
        ];
    }
}
