<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rule= [
            'category'=>[
                'required',
                'string',
                'max:50',
            ],
            'type_services'=>[
                'required',
                'string',
                'max:200',
            ],
            'description'=>[
                'required',
                'string',
                'max:200',
            ],
            'unit_price'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
            ],
            
            'size'=>[
                'required',
                'string',
                'max:50',
            ],
            'color'=>[
                'required',
                'string',
                'max:50',
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
            'category.required'=>'Please input product name',
            'description.required'=>'Please input description',
            'unit_price.numeric'=>'Please input your unit price, field must be a number',
            'type_services.required'=>'Please input type services',
            'size.required'=>'Please input size',
            'unit.required'=>'Please input unit',
            'color.required'=>'Please input color',
            'status.required'=>'Please select product status',
       
            
       ];
    
    }
}
