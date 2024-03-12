<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
class RegisterRequest extends FormRequest
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
            'username'=>[
                'required',
                'string',
                'max:50',
            ],
            'firstname'=>[
                'required',
                'string',
                'max:50',
            ],
            'lastname'=>[
                'required',
                'string',
                'max:50',
            ],
            'college'=>[
                'required',
                'string',
                'max:50',
            ],
            'department'=>[
                'required',
                'string',
                'max:50',
            ],
            'email'=>[
                'required',
                'string',
                'max:150',
                'unique:'.User::class,
            ],
            
            'contact_no'=>[
                'required',
                'string',
                'max:50',
            ],
            'cust_code'=>[
                'required',
                'string',
                'max:50',
            ],
            'role'=>[
                'required',
                'string',
                'max:50',
            ],
            'password'=>[
                'required',
                'string',
                'max:20',
                
            ],
           
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            'username.required'=>'Please input your username',
            'firstname.required'=>'Please input your firstname',
            'lastname.required'=>'Please input your lastname',
            'college.required'=>'Please input your college',
            'department.required'=>'Please input your department',
            'email.required'=>'Please input your email',
            'contact_no.required'=>'Please input your contact no',
            'password.required'=>'Please input your password',
            'role.required'=>'Please input your role',
           
            
       ];
    
    }
}


