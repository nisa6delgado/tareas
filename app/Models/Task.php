<?php

namespace App\Models;

class Task extends Model
{
    /**
     * The table associated with model.
     *
     * $var string
     */
    protected $table = 'tasks';

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
    protected $fillable = ['id_project', 'title', 'description', 'status'];

    public function project()
    {
        return $this->belongsTo('Project', 'id_project');
    }

    public function files()
    {
        return $this->hasMany('File', 'id_task');
    }

    public function comments()
    {
        return $this->hasMany('Comment', 'id_task');
    }
}
