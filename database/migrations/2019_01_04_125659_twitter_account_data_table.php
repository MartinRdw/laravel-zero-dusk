<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TwitterAccountDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_account_data', function (Blueprint $table) {
            $table->integer('twitter_account_id')->unsigned();
            $table->foreign('twitter_account_id')->references('id')->on('twitter_account')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('number_follower');
            $table->integer('number_following');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('twitter_account_data');
    }
}
