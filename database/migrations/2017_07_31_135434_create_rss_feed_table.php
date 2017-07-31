<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_feed', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->dateTime('pubDate');
            $table->string('link');
            $table->text('description');
            $table->integer('actioned')->default(0); // default is 0 = not actioned!
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rss_feed');
    }
}
