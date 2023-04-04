<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refractions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('OD_SPH')->nullable();
            $table->string('OD_CYL')->nullable();
            $table->string('OD_AXIS')->nullable();
            $table->string('OD_NVA')->nullable();
            $table->string('OD_PH')->nullable();
            $table->string('OD_CVA')->nullable();
            $table->string('OS_SPH')->nullable();
            $table->string('OS_CYL')->nullable();
            $table->string('OS_AXIS')->nullable();
            $table->string('OS_NVA')->nullable();
            $table->string('OS_PH')->nullable();
            $table->string('OS_CVA')->nullable();
            $table->string('ADD')->nullable();
            $table->string('PD')->nullable();
            $table->string('remarks')->nullable();
            $table->string('frame')->nullable();
            $table->string('lense')->nullable();
            $table->string('tint')->nullable();
            $table->string('particulars')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refractions');
    }
}
