<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OptimizeActivityTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize-activity-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old user activity logs.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::get();

        foreach ($users as $user) {
            $ids = DB::table('activity_log')
                ->where('causer_id', $user->id)
                ->orderByDesc('id')
                ->limit(1000)
                ->offset(1000)
                ->pluck('id');

            DB::table('activity_log')
                ->whereIn('id', $ids)
                ->delete();
        }
    }
}
