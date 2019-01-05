<?php

namespace App\Commands;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use LaravelZero\Framework\Commands\Command;

class GetTwitterData extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'insert:twitter_data';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Insert twitter data of account stored in the table twitter_account';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // get all twitter acount stored in database
        $twitterAccounts = DB::table('twitter_account')->get();

        $this->browse(function ($browser) use ($twitterAccounts) {

            foreach ($twitterAccounts as $twitterAccount) {

                $browser->visit('https://twitter.com/' . $twitterAccount->handle);

                // get current number of followers
                $numberFollower = $browser->attribute('.ProfileNav-item--followers > .ProfileNav-stat > .ProfileNav-value', 'data-count');

                // get current number of following
                $numberFollowing = $browser->attribute('.ProfileNav-item--following > .ProfileNav-stat > .ProfileNav-value', 'data-count');

                // insert values in database
                DB::table('twitter_account_data')->insert(array(
                    array(
                        'twitter_account_id' => $twitterAccount->id,
                        'number_follower' => $numberFollower,
                        'number_following' => $numberFollowing,
                        'date' => Carbon::now()->toDateTimeString()
                    ),
                ));
            }
        });
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule)
    {
         $schedule->command(static::class)->everyThirtyMinutes();
    }
}
