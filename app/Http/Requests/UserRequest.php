<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required|max:255|min:5',
            'email'=>'required',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', //
            'old_password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', //
        ];
    }
    public function messages(){
        return [
            'email.required'=>'Mail không đươc để trống',
            'email.unique'=>'email không được trùng',
            'name.required'=>'Tên không đươc để trống',
            'password.required'=>'Mật khẩu không đươc để trống',
            'password.regex'=>'Mật khẩu phải chứa các ký tự đặc biệt',
            'password.min'=>'Mật khẩu quá ngắn',
            'old_password.required'=>'Mật khẩu không đươc để trống',
            'old_password.regex'=>'Mật khẩu phải chứa các ký tự đặc biệt',
            'old_password.min'=>'Mật khẩu quá ngắn',
        ];
    }
}
