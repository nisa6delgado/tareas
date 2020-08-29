<?php

namespace App\Controllers;

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
	 * @return view
	 */
    public function index()
    {
        return view('layouts/index');
    }
}
