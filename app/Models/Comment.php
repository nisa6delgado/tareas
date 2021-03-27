<?php

namespace App\Models;

class Comment extends Model
{
    /**
     * The table associated with model.
     *
     * $var string
     */
    protected $table = 'comments';

    /**
     * The primary key of the model.
     *
     * $var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * $var array
     */
    protected $fillable = ['id_task', 'comment'];

    public function task()
    {
        return $this->belongsTo('Task', 'id_task');
    }
}
