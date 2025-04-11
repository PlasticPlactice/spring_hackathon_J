<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認証済みであれば true
    }

    public function rules()
    {
        return [
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => '現在のパスワードを入力してください。',
            'new_password.required' => '新しいパスワードを入力してください。',
            'new_password.min' => '新しいパスワードは8文字以上である必要があります。',
            'new_password.confirmed' => 'パスワード確認が一致していません。',
        ];
    }
}
