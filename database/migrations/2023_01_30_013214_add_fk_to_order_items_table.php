<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('refraction_id')->nullable()->after('id');
            $table->unsignedBigInteger('category_id')->nullable()->after('refraction_id');

            $table->foreign('refraction_id')
                ->references('id')
                ->on('refractions')
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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('refraction_id');
            $table->dropConstrainedForeignId('category_id');
        });
    }
}
