<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, LogsActivity, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'password']);
    }

    public function getInitialsAttribute(){
        $name = $this->name;
        $array = explode(' ',trim($name));
    
        $first = $array[0];
        $last = $array[count($array)-1];
    
        return $first[0] . ' ' . $last[0];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        $user = Config::where('key', 'photo')->first();

        if ($user) {
            return $user->value;
        }

        $user = Config::where('key', 'color')->first();
        $background = $user ? $user->value : '#000000';

        return 'https://ui-avatars.com/api/?name=' . $this->initials . '&color=FFFFFF&background= ' . $background;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
