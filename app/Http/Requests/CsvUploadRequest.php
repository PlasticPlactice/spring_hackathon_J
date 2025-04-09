<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules()
    {
        return [
            'csv_file' => 'required|file|mimes:csv,txt',
            'from_page' => 'required|in:admin,teacher',
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => 'CSVファイルを選択してください。',
            'csv_file.mimes' => 'CSVファイルの形式が正しくありません。',
            'from_page.required' => '遷移元情報が見つかりません。',
            'from_page.in' => '不正な遷移元です。',
        ];
    }
}
