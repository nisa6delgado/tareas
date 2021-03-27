<?php

namespace App\Models;

class File extends Model
{
    /**
     * The table associated with model.
     *
     * $var string
     */
    protected $table = 'files';

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
    protected $fillable = ['id_task', 'file'];

    public function task()
    {
        return $this->belongsTo('Task', 'id_task');
    }
}
