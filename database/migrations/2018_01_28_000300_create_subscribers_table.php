<?php

use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('sampoyigi_frontend_subscribers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('email', 128);
            $table->integer('statistics')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sampoyigi_frontend_subscribers');
    }
}