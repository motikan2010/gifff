<?php
declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Models\Image;

class ImageRepository
{

    public function findByIdIn(array $ids) {
        return Image::whereIn('id', $ids)->get();
    }
}