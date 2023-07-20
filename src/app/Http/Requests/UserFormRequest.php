<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'username' => ['required', 'min:4', 'max:20'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'input-user-thumbnail' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif'],
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'ユーザー名',
            'email' => 'メールアドレス',
            'password' => 'パスワード'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => ':attributeを入力してください。',
            'username.min' => ':attributeは4文字以上で入力してください。',
            'username.max' => ':attributeは20文字以内で入力してください。',
            'email.required' => ':attributeを入力してください。',
            'email.email' => '正しいメールアドレスの形式で入力してください。',
            'password.required' => ':attributeを入力してください。',
            'password.min' => ':attributeは8文字以上で入力してください。',
            'password.confirmed' => ':attributeが一致していません。',
            'input-user-thumbnail.file' => ':attributeを選択してください。',
            'input-user-thumbnail.image' => ':attributeは画像ファイルを選択してください。',
            'input-user-thumbnail.mimes' => ':attributeはjpeg,png,jpg,gif形式の画像ファイルを選択してください。',
        ];
    }
}
