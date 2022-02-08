<?php

namespace App\Models;

class Task extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_project', 'title', 'description', 'status', 'date_create', 'date_update'];

    /**
     * Get the project that owns the task.
     */
    public function project()
    {
        return $this->belongsTo('Project', 'id_project');
    }

    /**
     * Get the files for the task.
     */
    public function files()
    {
        return $this->hasMany('File', 'id_task')
            ->orderBy('file');
    }
}
