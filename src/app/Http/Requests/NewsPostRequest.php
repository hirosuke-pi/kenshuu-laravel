<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsPostRequest extends FormRequest
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
     */    public function rules(): array
    {
        return [
            'title' => ['required', 'min:5', 'max:50'],
            'body' => ['required'],
            'images.*' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '投稿内容',
            'images' => 'サムネイル画像',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ':attributeを入力してください。',
            'title.min' => ':attributeは5文字以上で入力してください。',
            'title.max' => ':attributeは50文字以内で入力してください。',
            'body.required' => ':attributeを入力してください。',
            'images.file' => ':attributeを選択してください。',
            'images.image' => ':attributeは画像ファイルを選択してください。',
            'images.mimes' => ':attributeはjpeg,png,jpg,gif形式の画像ファイルを選択してください。',
        ];
    }
}
