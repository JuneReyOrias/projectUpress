<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        $rule= [
            'product_name'=>[
                'required',
                'string',
                'max:50',
            ],
            'descritpion'=>[
                'required',
                'string',
                'max:200',
            ],
            'unit_price'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
            ],
            
     
            
            'status'=>[
                'required',
                'string',
                'max:50',
            ],
      
            
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            'product_name.required'=>'Please input product name',
            'descritpion.required'=>'Please input description',
            'unit_price.numeric'=>'Please input your unit price, field must be a number',
         
           
            'status.required'=>'Please select product status',
           
       ];
    
    }
}
