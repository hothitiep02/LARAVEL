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
     * @return array<string, mixed>
     */

        public function rules()
        {
            return [
                'email' => 'required|string|email|max:255', // Thêm 'email' để kiểm tra định dạng email
                'full_name' => 'required|string|max:255',
                'password' => 'required|string|min:8', // Thêm min:8 để yêu cầu mật khẩu tối thiểu 8 ký tự
                'c_password' => 'required|string|max:255|same:password', // Thêm same:password để kiểm tra xác nhận mật khẩu
            ];
        }

        public function messages()
        {
            return [
                'email.required' => 'Email không được để trống.',
                'email.string' => 'Email phải là một chuỗi.',
                'email.email' => 'Email không đúng định dạng.',
                'email.max' => 'Email không được vượt quá 255 ký tự.',
        
                'full_name.required' => 'Tên không được để trống.',
                'full_name.string' => 'Tên phải là một chuỗi.',
                'full_name.max' => 'Tên không được vượt quá 255 ký tự.',
        
                'password.required' => 'Mật khẩu không được để trống.',
                'password.string' => 'Mật khẩu phải là một chuỗi.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        
                'c_password.required' => 'Xác nhận mật khẩu không được để trống.',
                'c_password.string' => 'Xác nhận mật khẩu phải là một chuỗi.',
                'c_password.max' => 'Xác nhận mật khẩu không được vượt quá 255 ký tự.',
                'c_password.same' => 'Xác nhận mật khẩu không khớp với mật khẩu.',
            ];
        }
}
