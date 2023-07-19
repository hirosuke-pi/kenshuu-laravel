<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LoginFormRequest extends FormRequest
{
    protected $redirectRoute = 'view.login';
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
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => ':attributeを入力してください。',
            'email.email' => '正しいメールアドレスの形式で入力してください。',
            'password.required' => ':attributeを入力してください。'
        ];
    }

    public function failedAuthorization() {
        status('error', implode('\n', $this->validator->errors()->all()));
        return redirect()->route('home');
    }
}
