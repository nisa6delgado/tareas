<?php

namespace App\Controllers;

use App\Models\Comment;

class Comments extends Controller
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

    public function store()
    {
        $comment = Comment::create([
            'id_task' => post('id_task'),
            'comment' => post('comment'),
        ]);

        return $comment;
    }

    public function delete($id)
    {
        Comment::find($id)->delete();
    }
}
