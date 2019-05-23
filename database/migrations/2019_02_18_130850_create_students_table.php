<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('students', function (Blueprint $table) {
            $table->integer('id');
            $table->string('id_num');
            $table->string('name');
            $table->string('sex');
            $table->string('course');
            $table->string('year');
            
        });
        Artisan::call('db:seed', [
            '--class' => StudentsTableSeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
