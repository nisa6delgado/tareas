<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
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
        try {
            $users = User::get();

            foreach ($users as $user) {
                $ids = DB::table('activity_log')
                    ->where('user_id', $user->id)
                    ->orderByDesc('id')
                    ->skip(1000)
                    ->pluck('id');

                DB::table('activity_log')
                    ->whereIn('id', $ids)
                    ->delete();
            }
        }

        catch (Exception $exception) {
            $subject = env('app_name') . ' | Optimize activity table cron error';

            mail(
                env('email_cron_error'),
                $subject,
                $exception->getMessage()
            );
        }
    }
}
