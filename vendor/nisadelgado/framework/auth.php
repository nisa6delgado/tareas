<?php

/**
 * Register new user.
 *
 * @param  array $user
 * @return void
 */
function logup($user)
{
    $email = App\Models\User::where('email', $user['email'])->get();

    if ($email->count() > 0) {
        echo 'Correo electrónico ya existe';
        return;
    }

    $user = App\Models\User::create([
        'name'     => $user['name'],
        'email'    => $user['email'],
        'password' => md5($user['password']),
    ]);

    $user->update(['hash' => md5($user->id)]);
}

/**
 * Login a session.
 *
 * @param array $user
 * @return void
 */
function login($user)
{
    $user = App\Models\User::where('email', $user['email'])
        ->where('password', md5($user['password']))
        ->whereNull('oauth')
        ->first();

    if ($user) {
        $_SESSION['id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        $_SESSION['role'] = $user->role;
        $_SESSION['permissions'] = $user->permissions;
        $_SESSION['photo'] = $user->photo;
    } else {
        echo 'Datos incorrectos';
    }
}

/**
 * Get a session var.
 *
 * @param  mixed  $var
 * @param  array\boolean\string
 */
function logged($var = '')
{
    if ($var == '') {
        if (isset($_SESSION['name'])) {
            return $_SESSION;
        } else {
            return false;
        }
    } else {
        if (isset($_SESSION[$var])) {
            return $_SESSION[$var];
        }
    }
}

/**
 * Send email for reset password.
 *
 * @return void
 */
function forgot()
{
    if (post()) {
        $user = App\Models\User::where('email', post('email'))->first();

        if (!$user) {
            echo 'Este correo electrónico no se encuentra registrado';
            return;
        }

        $body = 'Por favor, haga click <a href="http://' . host() . '/recover/' . md5($user->id) . '">aquí</a> para recuperar su contraseña';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset: utf-8' . "\r\n";
        $headers .= 'From: Administrador <admin@' . host() . '>' . "\r\n";
        mail($user->email, 'Recuperar contraseña', $body, $headers);
    }
}

/**
 * Recover password.
 *
 * @return void
 */
function recover()
{
    if (post()) {
        $user = App\Models\User::where('hash', post('id'))->first();

        if (!$user) {
            echo 'Enlace enválido';
            return;
        }

        $user->password = md5(post('password'));
        $user->save();
    }

}

/**
 * Logout session.
 *
 * @return void
 */
function logout()
{
    session_destroy();
}
