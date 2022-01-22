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

    /**
     * Create a comment.
     *
     * @return Comment
     */
    public function store(): Comment
    {
        $comment = Comment::create([
            'id_task' => post('id_task'),
            'comment' => post('comment'),
        ]);

        return $comment;
    }

    /**
     * Delete a comment.
     *
     * @return void
     */
    public function delete(int $id): void
    {
        Comment::find($id)->delete();
    }
}
