<?php

namespace App\Controllers;

use View;

class Layouts extends Controller
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
	 * Show layout page.
	 *
	 * @return View
	 */
    public function index(): View
    {
        return view('layouts/index');
    }
}
