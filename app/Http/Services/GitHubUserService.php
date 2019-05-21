<?php
declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;

define('GITHUB_LOGIN_TYPE', '1'); // GitHubのログインタイプ

/**
 *
 * Class GitHubUserService
 */
class GitHubUserService
{

    /**
     * ログインユーザがDBに存在したらユーザ情報を返却。
     * DBに存在していない場合は、新規に挿入しユーザ情報を返却。
     *
     * @param $userId
     * @param $name
     * @return User
     */
    public function getUser($userId, $name) : User {
        $user = $this->getUserById($userId);

        if ( $user == null ) {
            return $this->createUser($userId, $name);
        } else {
            return $user;
        }
    }

    /**
     * ログインIDからユーザ情報を取得
     *
     * @param int $loginId
     * @return User|null
     */
    private function getUserById(int $loginId) : ?User {
        return User::where('login_id', $loginId)->where('login_type', '1')->first();
    }

    /**
     * ユーザを新規作成
     *
     * @param int $loginId
     * @param string $name
     * @return User
     */
    private function createUser(int $loginId, string $name) : User {
        $user = User::create([
            'login_type' => GITHUB_LOGIN_TYPE,
            'login_id' => $loginId,
            'name' => $name,
        ]);
        return $user;
    }

    /**
     * ユーザログイン
     *
     * @param User $user
     */
    public function login(User $user) {
        Auth::login($user);
    }

}