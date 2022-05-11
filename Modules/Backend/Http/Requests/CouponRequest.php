<?php

namespace  Modules\Backend\Http\Requests; 
use Illuminate\Foundation\Http\FormRequest; 

class CouponRequest extends FormRequest
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
        $id=$this->segment(3);
        return 
                [   
                    'coupon_code'       =>   "required|max:255|unique:coupon,coupon_code,$id,id",
                    "status"            =>  "required|numeric", 
                    "offer"             =>  "required|numeric",   
                ];
		
    }
    public function messages()
    {
       return [ 
            "status.numeric"   => 'The status field is required..' 
        ];
    }    
}
