<?php

namespace App\Controllers;

use App\Models\Configuration;
use View;
use Redirect;

class Configurations extends Controller
{
    /**
     * Verify if user is logged.
     *
     * @return auth
     */
    public function __construct()
    {
        $this->middleware('Auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit(): View
    {
        $configurations = Configuration::get();
        return view('configurations.edit', compact('configurations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Redirect
     */
    public function update(): Redirect
    {
        foreach (request() as $key => $value) {
            $value = ($key == 'password') ? md5($value) : $value;

            $configuration = Configuration::where('key', $key)->first();
            $configuration->update(['value' => $value]);
        }

        return redirect('/');
    }
}
