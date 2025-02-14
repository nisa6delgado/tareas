<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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
