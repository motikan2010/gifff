<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{

    /**
     * ファイルアップロード
     *
     * @param Request $request
     * @return array
     */
    public function upload(Request $request) {

        // バリデーション
        $validator = $this->validationUpload($request);
        if ( !$validator->fails() ) {
            $filename = $request->file->store('public/image');

            return [
                'fileName' => $filename
            ];
        } else {
            $errors = [];
            // var_dump( $validator->errors()->messages() );exit();
            foreach ( $validator->errors()->messages() as $param => $message) {
                $errors[] = [
                    'param' => $param,
                    'message' => $message,
                ];
            }
            return [
                'status' => 'error',
                'errors' => $errors,
            ];
        }
    }

    private function validationUpload(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
                // 最大縦横1000px
                'dimensions:max_width=10000,max_height=10000',
            ]
        ]);
        return $validator;
    }
}
