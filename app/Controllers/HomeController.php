<?php

namespace App\Controllers;

use App\Models\Project;
use DB;
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
    public function index()
    {
        $chart['projects'] = Project::orderBy('name')
            ->get()
            ->pluck('name');

        $chart['colors'] = Project::orderBy('name')
            ->get()
            ->pluck('color');

        $chart['tasks'] = DB::table('tasks')
            ->leftJoin('projects', 'tasks.id_project', '=', 'projects.id')
            ->select(DB::raw('projects.name AS project, COUNT(1) AS quantity'))
            ->groupBy('tasks.id_project')
            ->orderBy('project')
            ->get()
            ->pluck('quantity');

        return view('home.index', compact('chart'));
    }
}
