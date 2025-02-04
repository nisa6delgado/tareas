<?php

namespace App\Models;

use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function getStatusNameAttribute()
    {
        return $this->status ? __('tasks.completed') : __('tasks.pending');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
