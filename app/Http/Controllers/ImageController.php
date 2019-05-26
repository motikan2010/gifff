<?php

namespace App\Http\Controllers;

use App\Http\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{

    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->middleware('auth');
    }


    public function uploadPage() {
        return view('image.1_1_upload');
    }

    public function upload(Request $request) {
        // バリデーション
        $validator = $this->imageService->validationUpload($request);
        if ( $validator->fails() ) {
            // Error
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Success
            $filenameArr = $this->imageService->multiUpload(Auth::user()->id, $request->file);
            return redirect('/image/upload')->with('message', 'Upload is completed.');
        }
    }

    public function listPage() {
        $images = $this->imageService->getMyImageList(Auth::user()->id);
        return view('image.2_1_image_list')->with(['images' => $images]);
    }

    public function createGifPage() {
        return view('image.3_1_create_gif');
    }
}
