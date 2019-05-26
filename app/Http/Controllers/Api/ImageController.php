<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * ファイルアップロード
     *
     * @param Request $request
     * @return array
     */
    public function upload(Request $request) {

        // バリデーション
        $validator = $this->imageService->validationUpload($request);
        if ( !$validator->fails() ) {
            $filename = $this->imageService->singleUpload($request->file);
            return [
                'fileName' => $filename
            ];

        } else {
            $errors = [];
            foreach ( $validator->errors()->messages() as $param => $message ) {
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
}
