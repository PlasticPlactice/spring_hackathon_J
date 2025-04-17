<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show($filename)
    {
        // 画像のパスを取得
        $path = storage_path('app/public/images/' . $filename);

        // 画像が存在しない場合は 404 エラー
        if (!file_exists($path)) {
            abort(404);
        }

        // 画像をレスポンスとして返す
        return response()->file($path);
    }
}
