<?php

namespace App\Console;

use App\Console\Commands\NotifyOwnership;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\NotifyOwnershipJob;
use App\Models\Ownership;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        NotifyOwnership::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         *     * * * * *   root     php /path/para/projeto/artisan notifications:ownership-simplified --all
         *     * * * * *   root    cd /path/para/projeto && php artisan notifications:ownership-simplified --all
         *     * 2 * * 0   root    cd /path/para/projeto && php artisan notifications:ownership-simplified --all    ->  todo domingo 2h da manhã
         * 
         *          
         */

        // $schedule->command('notifications:ownership-simplified --all')->everyMinute();
        

        $schedule->call(function () {
            $ownerships_with_ticket = Ownership::where('traffic_ticket', '1')->get();
            
            foreach ($ownerships_with_ticket as $ownership) {
                Artisan::call("notifications:ownership-simplified {$ownership->cpf}");
                
                // NotifyOwnershipJob::dispatch($ownership);
            }
        })->everyMinute();

                                                                /**
                                                                 * Frequencias
                                                                 * 
                                                                 * ->cron('* * * * *');	
                                                                 * ->everyMinute();
                                                                 * ->everyFiveMinutes();
                                                                 * ->hourly();
                                                                 * ->hourlyAt(17);
                                                                 * ->daily(); - roda meia noite
                                                                 * ->dailyAt('13:00');
                                                                 * ->twiceDaily(1, 13);
                                                                 * ->weekly();
                                                                 * ->weeklyOn(1, '8:00'); -  Monday at 8:00
                                                                 * ->monthly();
                                                                 * ->monthlyOn(4, '15:00');
                                                                 * ->lastDayOfMonth('15:00');
                                                                 * ->quarterly();
                                                                 * ->yearly();
                                                                 * ->timezone('America/New_York');
                                                                 */

                                                                /**
                                                                * Constraints
                                                                * 
                                                                * ->weekdays();	
                                                                * ->weekends();
                                                                * ->days([Schedule::SUNDAY, Schedule::WEDNESDAY]);
                                                                * ->between($startTime, $endTime);
                                                                * ->unlessBetween($startTime, $endTime);	
                                                                */


        // Falar depois das jobs


        // $schedule->call(function () {
        //     $ownerships_with_ticket = Ownership::where('traffic_ticket', '1');

        //     foreach ($ownerships_with_ticket as $ownership) {
        //         NotifyOwnershipJob::dispatch($ownership);
        //     }
        // })->everyMinute();


        // EXEC

        /*
            $schedule->exec('node /home/forge/script.js')->daily();
        */

        /*
            Truth test constraint

            $schedule->command('emails:send')->daily()->when(function () {

                $daily_tickets = Tickets::where('occurence_date', date('Y-m-d'))->count();
                return true;
            });

            $schedule->command('emails:send')->daily()->skip(function () {
                return true;
            });
        */

        /*
        ****** OU ******

        $schedule->call(function () {
            DB::table('daily_tickets')->delete();
        });
        
        */
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
