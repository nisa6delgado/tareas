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
        $dates = DB::table('tasks')
            ->select(DB::raw('DATE(date_update) AS datef, STRFTIME("%d/%m", DATE(date_update)) || "/" || SUBSTR(STRFTIME("%Y", date_update), 3, 2) AS date, COUNT(1) AS quantity'))
            ->groupBy('datef')
            ->orderBy('datef')
            ->get();

        $tasks = DB::table('tasks')
            ->leftJoin('projects', 'tasks.id_project', '=', 'projects.id')
            ->select(DB::raw('projects.name AS project, projects.color, COUNT(1) AS quantity'))
            ->groupBy('tasks.id_project')
            ->orderByDesc('quantity')
            ->get();

        $status = DB::table('tasks')
            ->select(DB::raw('CASE WHEN status THEN "Finalizada" ELSE "Pendiente" END AS status, CASE WHEN status THEN "green" ELSE "orange" END AS color, COUNT(1) AS quantity'))
            ->groupBy('status')
            ->orderByDesc('quantity')
            ->get();

        return view('home.index', compact('dates', 'status', 'tasks'));
    }
}
