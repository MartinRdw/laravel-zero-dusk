<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TwitterAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('twitter_account')->insert(array(
            array(
                'handle' => 'taylorotwell'
            ),
            array(
                'handle' => 'enunomaduro'
            ),
            array(
                'handle' => 'martin_riedweg'
            ),
            array(
                'handle' => 'VitalikButerin'
            ),
        ));
    }
}
