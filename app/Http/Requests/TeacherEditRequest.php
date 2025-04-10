<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// 教師データの更新で利用する
class TeacherEditRequest extends FormRequest
{
    public function rules()
    {
        return [

            'password_reset' => 'sometimes|boolean',            
            'name' => 'required|string|max:255',  
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password_reset.boolean' => 'パスワードリセットで送信された値は想定されていません',
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列でなければなりません。',
            'name.max' => '名前は255文字以内で入力してください。',
            
        ];
    }

}
