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
            'input-new-thumbnail' => ['nullable', 'file', 'image'],
            'news-images.*' => ['nullable', 'file', 'image'],
            'tags.*' => ['nullable', 'int'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '投稿内容',
            'input-new-thumbnail' => 'サムネイル画像',
            'news-images.*' => '画像',
            'tags.*' => 'タグ',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ':attributeを入力してください。',
            'title.min' => ':attributeは5文字以上で入力してください。',
            'title.max' => ':attributeは50文字以内で入力してください。',
            'body.required' => ':attributeを入力してください。',
            'input-new-thumbnail.file' => ':attributeを選択してください。',
            'input-new-thumbnail.image' => ':attributeは画像ファイルを選択してください。',
            'news-images.*.file' => ':attributeを選択してください。',
            'news-images.*.image' => ':attributeは画像ファイルを選択してください。',
        ];
    }
}
