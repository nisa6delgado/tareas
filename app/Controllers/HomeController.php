<?php

namespace App\Controllers;

use App\Models\Task;
use View;
use Redirect;

class HomeController extends Controller
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
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $tasks = Task::where('status', 0)
            ->where('status', '!=', 1)
            ->with('project')
            ->orderByDesc('id')
            ->limit(10)
            ->get();

        return view('home.index', compact('tasks'));
    }
}
