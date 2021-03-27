<?php

namespace App\Models;

class Project extends Model
{
    /**
     * The table associated with model.
     *
     * $var string
     */
    protected $table = 'projects';

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
    protected $fillable = ['id_user', 'name', 'description', 'icon', 'color', 'slug'];

    public function tasks()
    {
        return $this->hasMany('Task', 'id_project');
    }
}
