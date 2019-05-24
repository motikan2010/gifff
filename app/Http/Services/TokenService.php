<?php
declare(strict_types=1);

namespace App\Http\Services;


use App\Http\Models\TokenInformation;
use App\Http\Models\User;

class TokenService
{

    public function getTokensByUserId(User $user)  {
        return $user->tokens()->get();
    }

    public function createToken(int $userId) {
        $token = $this->getUniqueToken();
        TokenInformation::create([
            'user_id' => $userId,
            'token' => $token,
        ]);
    }


    private function getUniqueToken () : string {
        $token = '';
        while ( true ) {
            $token = str_random(40);
            if ( $this->isUniqueToken($token) ) {
                break;
            }
        }
        return $token;
    }

    private function isUniqueToken(string $token) : bool {
        $tokenInfo = TokenInformation::where('token', $token)->first();
        if ( $tokenInfo === null) {
            return true;
        } else {
            return false;
        }
    }
}