<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::count();

        if (! $users) {
            $name = text(
                label: 'Name:',
                required: true
            );
    
            $email = text(
                label: 'Email:',
                required: true,
                validate: ['email' => 'email']
            );
    
            $password = password(
                label: 'Password:',
                required: true
            );
    
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
    
            $this->info('User created');
        }
    }
}
