<?php

namespace App\Controllers;

use App\Models\Configuration;
use View;
use Redirect;

class Auth extends Controller
{
    /**
     * Display a login page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Login user.
     *
     * @return Redirect
     */
    public function login(): Redirect
    {
        $user = Configuration::where('key', 'user')->first()->value;
        $password = Configuration::where('key', 'password')->first()->value;

        if ($user == request('user') && $password == md5(request('password'))) {
            session('authenticate', 1);
            return redirect('/');
        }

        return redirect('/login')->with('error', 'Datos incorrectos');
    }
}
