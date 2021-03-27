<?php

namespace App\Controllers;

use App\Models\Task;

class Dashboard extends Controller
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
    	$tasks = Task::where('status', 0)->orderBy('id', 'DESC')->limit(10)->get();
    	return view('dashboard/index', compact('tasks'));
    }
}
