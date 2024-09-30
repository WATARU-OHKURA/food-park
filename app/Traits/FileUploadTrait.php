<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait FileUploadTrait
{

    // function uploadImage(Request $request, $inputName, $oldPath = NULL, $path = "/uploads")
    // {

    //     if ($request->hasFile($inputName)) {

    //         $image = $request->{$inputName};
    //         $ext = $image->getClientOriginalExtension();
    //         $imageName = 'media_' . uniqid() . '.' . $ext;

    //         $image->move(public_path($path), $imageName);

    //         // Delete previous file if exist
    //         if ($oldPath && File::exists(public_path($oldPath))) {
    //             File::delete(public_path($oldPath));
    //         }

    //         return $path . '/' . $imageName;
    //     }

    //     return NULL;
    // }

    function uploadImage(Request $request, $inputName)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);

            // 画像の内容を取得
            $imageData = file_get_contents($image->getRealPath());

            // MIMEタイプを取得
            $mimeType = $image->getClientMimeType();

            // Base64エンコード
            $base64 = base64_encode($imageData);

            // データURL形式に整形
            $base64String = 'data:' . $mimeType . ';base64,' . $base64;

            return $base64String;
        }

        return null;
    }


    // Remove file
    function removeImage(string $path): void
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
