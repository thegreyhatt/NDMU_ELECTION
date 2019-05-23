<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('position');
            $table->integer('order');
            $table->boolean('is_ssg')->nullable();
            });
            Artisan::call('db:seed', [
                '--class' => PositionsTableSeeder::class,
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('positions');
    }
}
