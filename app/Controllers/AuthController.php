<?php

namespace App\Controllers;

use App\Models\Configuration;
use App\Validations\LoginValidation;
use View;
use Redirect;

class AuthController extends Controller
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
    public function login(LoginValidation $validation): Redirect
    {
        $user       = Configuration::where('key', 'user')->first()->value;
        $password   = Configuration::where('key', 'password')->first()->value;

        if ($user == request('user') && $password == encrypt(request('password'))) {
            session('authenticate', 1);
            return redirect('/');
        }

        return redirect('/login')->with('error', 'Datos incorrectos');
    }

    /**
     * Logout user.
     *
     * @return Redirect
     */
    public function logout(): Redirect
    {
        logout();
        return redirect('/login');
    }
}
