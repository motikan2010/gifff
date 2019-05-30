<?php
declare(strict_types=1);

namespace App\Http\Services;


use App\Http\Models\Image;
use App\Http\Repository\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GifCreator\GifCreator;

define('UPLOAD_PATH', 'public/img/upload');

class ImageService
{

    private $imageRepo;

    public function __construct(ImageRepository $imageRepo)
    {
        $this->imageRepo = $imageRepo;
    }

    public function getMyImageList(int $userId) {
        $images = Image::where('user_id', $userId)->get();
        return $images;
    }

    /**
     * 1つのファイルをアップロード
     *
     * @param UploadedFile $uploadedFile
     * @return false|string
     */
    public function singleUpload(UploadedFile $uploadedFile) {
        $filename = $this->upload($uploadedFile);
        return $filename;
    }

    /**
     * 複数の画像をアップロード
     *
     * @param int $userId
     * @param array $uploadedFileArray
     * @return array ファイル名の配列
     */
    public function multiUpload(int $userId, array $uploadedFileArray) {
        // バリデーションチェック
        foreach ( $uploadedFileArray as $uploadedFile ) {
            if ( !($uploadedFile instanceof UploadedFile) ) {
                return [];
            }
        }

        // アップロード
        $filenameArray = [];
        foreach ( $uploadedFileArray as $uploadedFile ) {
            $filename = $this->upload($uploadedFile);
            $filenameArray[] = $filename;
        }

        // DBに登録
        $this->insertImage($userId, $filenameArray);

        return $filenameArray;
    }

    /**
     * 画像をアップロード
     *
     * @param UploadedFile $uploadedFile
     * @return false|string ファイル名
     */
    private function upload(UploadedFile $uploadedFile) {
        $filename = $uploadedFile->store(UPLOAD_PATH);
        $filename = str_replace(UPLOAD_PATH . '/', '', $filename);
        return $filename;
    }

    /**
     * ファイル情報をDBに登録
     *
     * @param int $userId ユーザID
     * @param array $filenameArr ファイル名の配列
     */
    private function insertImage(int $userId, array $filenameArr) {
        $now = date('Y-m-d H:i:s');
        $record = [];
        foreach ( $filenameArr as $filename) {
            $record[] = [
                'user_id' => $userId,
                'filename' =>  $filename,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table((new Image())->getTable())->insert($record);
    }

    /**
     * 画像アップロード時のバリデーション
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validationUpload(Request $request) {
        $validator = Validator::make($request->all(), [
            'file.0' => [
                'required',
            ],
            'file.*' => [
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpg,jpeg,png',
                // 最大縦横1000px
                'dimensions:max_width=10000,max_height=10000',
            ]
        ]);
        return $validator;
    }

    /**
     * @param array $imageIds
     */
    public function createGif(array $imageIds) {
        $imageArr = $this->imageRepo->findByIdIn($imageIds);

        $frames = [];
        foreach ( $imageArr as $image) {
            $frames[] = storage_path('app') . '/' . UPLOAD_PATH . '/' .$image->filename;
        }

        $gc = new GifCreator();
        $durations = array(40, 80, 40, 20);
        $gc->create($frames, $durations, 0);
        $gifBinary = $gc->getGif();

        // TODO 作成したGIFを返却
    }

}