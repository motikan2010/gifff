<?php
declare(strict_types=1);

namespace App\Http\Controllers;


class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('account.index');
    }
}