<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// 生徒情報の更新で利用する
class StudentEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules()
    {
        return [

            'password_reset' => 'sometimes|boolean',            
            'name' => 'required|string|max:255',  
            'img_data' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',  // 画像はオプションで、JPEG, PNG, JPG, GIFのいずれかで最大2MB
            'department' => 'required|exists:departments,id',  // 学科は必須で、departmentsテーブルのidが存在すること
            'entrance_year' => 'required|integer',  // 入学年度は2020年から2030年までの整数であること
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
            'img_data.image' => 'アップロードされたファイルは画像でなければなりません。',
            'img_data.mimes' => '画像はJPEG, PNG, JPG, GIF形式のみ対応しています。',
            'img_data.max' => '画像のサイズは8MB以下でなければなりません。',
            'department.required' => '学科は必須です。',
            'department.exists' => '選択した学科は存在しません。',
            'entrance_year.required' => '入学年度は必須です。',
            'entrance_year.integer' => '入学年度は整数でなければなりません。',
        ];
    }

}
