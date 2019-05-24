<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Services\TokenService;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexPage() {
        return view('account.1_1_index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tokenPage() {
        $tokens = $this->tokenService->getTokensByUserId(Auth::user());
        return view('account.2_1_token_list')->with([
            'tokens' => $tokens,
        ]);
    }

    /**
     *
     */
    public function createToken() {
        $user = Auth::user();
        $this->tokenService->createToken($user->id);
        return redirect('/account/token')->with('message', 'Token Creation is completed.');
    }
}