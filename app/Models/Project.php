<?php

namespace App\Models;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

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
    protected $fillable = ['name', 'icon', 'color', 'slug'];

    /**
     * Get the tasks for the task.
     */
    public function tasks()
    {
        return $this->hasMany('Task', 'id_project');
    }

    /**
     * Get the default color.
     *
     * @param  string  $value
     * @return string
     */
    public function getColorAttribute($value)
    {
        if (!$value) {
            return 'black';
        }

        return $value;
    }
}
