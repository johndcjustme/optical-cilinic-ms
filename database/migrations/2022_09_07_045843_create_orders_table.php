<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('orders', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        //     $table->unsignedBigInteger('supplier_id')->nullable();
        //     $table->unsignedBigInteger('patient_id');
            
        //     $table->foreign('supplier_id')
        //         ->references('id')
        //         ->on('suppliers')
        //         ->nullOnDelete();

        //     $table->foreign('patient_id')
        //         ->references('id')
        //         ->on('patients')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('orders');
    }
}



