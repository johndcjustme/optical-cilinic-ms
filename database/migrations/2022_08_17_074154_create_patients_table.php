<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('address')->nullable();
            $table->string('occupation')->nullable(); 
            $table->string('mobile_1')->nullable(); 
            $table->string('mobile_2')->nullable(); 
            $table->string('email')->unique()->nullable(); 
            $table->boolean('gender')->nullable(); 
            $table->integer('queue')->default(0); 
            $table->datetime('date_queue')->nullable(); 
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
        Schema::dropIfExists('patients');
    }
}
