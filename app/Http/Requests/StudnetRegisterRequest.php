<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudnetRegisterRequest extends FormRequest
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
        return [
            'from_page' => 'required|in:admin,teacher',
        ];
    }

    public function messages()
    {
        return [
            'from_page.required' => '遷移元情報が見つかりません。',
            'from_page.in' => '不正な遷移元です。',
        ];
    }
}
