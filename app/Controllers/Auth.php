<?php

namespace App\Controllers;

class Auth extends Controller
{
    /**
     * Show login form.
     *
     * @return view
     */
    public function index()
    {
        return view('auth/login');
    }

    /**
     * Show register form.
     *
     * @return view
     */
    public function register()
    {
        return view('auth/register');
    }

    /**
     * Register user.
     *
     * @return void
     */
    public function logup()
    {
        logup(post());
    }

    /**
     * Login user.
     *
     * @return void
     */
    public function login()
    {
        login(post());
    }

    /**
     * Login user with Facebook account.
     *
     * @return redirect
     */
    public function facebook()
    {
        facebook()->login();
    }

    /**
     * Show and process forgot password form.
     *
     * @param view|void
     */
    public function forgot()
    {
        if (post()) {
            return forgot();
        }

        return view('auth/forgot');
    }

    /**
     * Show and process recover password form.
     *
     * @param view|void
     */
    public function recover($id)
    {
        if (post()) {
            return recover();
        }

        return view('auth/recover', compact('id'));
    }

    /**
     * Logout user.
     *
     * @return redirect
     */
    public function logout()
    {
        logout();
        return redirect('/login');
    }
}
