<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function updateLanguageFile(Request $request, $locale)
    {
        // 在這裡實現更新語言檔的邏輯，接收客戶端傳遞的修改後的語言內容
    }

    public function getLanguageFile($locale)
    {
        $filePath = resource_path("lang/$locale/messages.php");
        if (file_exists($filePath)) {
            return response()->json(require $filePath);
        }
        return response()->json([], 404);
    }
}
