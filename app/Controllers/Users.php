<?php

namespace App\Controllers;

use App\Models\User;

class Users extends Controller
{
    /**
     * Verify if user is logged.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('Auth');
    }

    /**
     * Show home page.
     *
     * @return view
     */
    public function index()
    {
        $users = User::get();
        return view('users/index', compact('users'));
    }

    /**
     * Show create user page.
     *
     * @return view
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store user in database.
     *
     * @return void\User
     */
    public function store()
    {
        $file = files()->input('photo')->upload('resources/assets/img/users');

        $user = User::where('email', post('email'))->first();

        if ($user) {
            return 'Correo electrónico existe';
        }

        $user = User::create([
            'name'     => post('name'),
            'email'    => post('email'),
            'password' => md5(post('password')),
            'photo'    => $file->filename,
        ]);

        $user->update(['hash' => md5($user->id)]);
    }

    /**
     * Show edit user page.
     *
     * @return view
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users/edit', compact('user'));
    }

    /**
     * Update user in database.
     *
     * @return void\User
     */
    public function update()
    {
        $file = files()->input('photo')->upload('resources/assets/img/users');

        $user = User::where('email', post('email'))
            ->where('id', '!=', post('id'))
            ->first();

        if ($user) {
            return 'Correo electrónico existe';
        }

        $user = User::find(post('id'));
        $user->update([
            'name'  => post('name'),
            'email' => post('email'),
        ]);

        if (post('password')) {
            $user->update([
                'password' => md5(post('password')),
            ]);
        }

        if ($file->filename != '') {
            $user->update([
                'photo' => $file->filename,
            ]);
        }

        if ($user->id == auth()->id) {
            session('name', $user->name);
            session('photo', $user->photo);

            return $user;
        }
    }

    /**
     * Delete user in database.
     *
     * @return void
     */
    public function delete($id)
    {
        User::find($id)->delete();
    }
}
