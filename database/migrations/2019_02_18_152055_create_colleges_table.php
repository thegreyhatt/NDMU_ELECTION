<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('college');
            $table->text('description')->nullable();
            $table->timestamps();
            
            });
            Artisan::call('db:seed', [
                '--class' => CollegesTableSeeder::class,
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('colleges');
    }
}
