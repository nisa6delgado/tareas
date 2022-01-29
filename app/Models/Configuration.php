<?php

namespace App\Models;

class Configuration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configurations';

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
    protected $fillable = ['key', 'value'];
}
