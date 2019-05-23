<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\GitHubUserService;
use Laravel\Socialite\Facades\Socialite;

class GitHubLoginController extends Controller
{

    private $userService;

    private $redirectTo = '/account';

    public function __construct(GitHubUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $loginUser = $this->userService->getUser($user->id, $user->nickname);
        $this->userService->login($loginUser);
        return redirect($this->redirectTo);
    }
}
