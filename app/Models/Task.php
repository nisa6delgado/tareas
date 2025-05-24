<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

#[ScopedBy([UserScope::class])]
class Task extends Model
{
    use LogsActivity;
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['project_id', 'title', 'format', 'description', 'status']);
    }
    
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
