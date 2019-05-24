<?php
declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'login_type', 'login_id', 'name'
    ];

    public function tokens() {
        return $this->hasMany('App\Http\Models\TokenInformation', 'user_id', 'id');
    }
}
