<?php

namespace App\Models;

class User extends Model
{
    /**
     * The table associated with model.
     *
     * $var string
     */
    protected $table = 'users';

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
    protected $fillable = ['photo', 'name', 'email', 'password', 'role', 'permissions', 'oauth', 'hash'];

    /**
     * Set the user's first name.
     *
     * @param  string $value
     * @return void
     */
    public function setPhotoAttribute($value)
    {
        if ($value != '') {
            $this->attributes['photo'] = '/resources/assets/img/users/' . $value;
        }
    }
}
