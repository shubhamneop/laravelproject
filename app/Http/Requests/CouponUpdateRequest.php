<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
          'title'=>'required',
           'code'=>'required|regex:/^[a-zA-Z0-9_\-]*$/|unique:coupons,code,'.$this->coupon->id,
           'type'=>'required',
         'discount'=>'required',
        ];
    }
}
