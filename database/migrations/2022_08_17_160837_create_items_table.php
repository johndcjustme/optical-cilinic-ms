<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('supplier_id')->default(null)->nullable();
            $table->unsignedBigInteger('category_id')->default(null)->nullable(); 
            $table->string('image')->nullable(); 
            $table->string('name');
            $table->string('description')->nullable(); 
            $table->integer('quantity')->default(0)->nullable();
            $table->string('size')->nullable(); 
            $table->string('type')->nullable(); 
            $table->string('unit')->nullable(); 
            $table->double('price')->default(0)->nullable(); 
            $table->double('cost')->default(0)->nullable(); 
            $table->integer('buffer')->default(0)->nullable(); 
            $table->string('sph')->nullable(); 
            $table->string('cyl')->nullable(); 
            $table->datetime('in_date')->nullable(); 
            $table->datetime('out_date')->nullable(); 
            $table->timestamps();

            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->nullOnDelete();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
