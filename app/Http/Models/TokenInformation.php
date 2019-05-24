<?php
declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TokenInformation extends Model
{

    protected $fillable = [
        'user_id', 'token'
    ];

}