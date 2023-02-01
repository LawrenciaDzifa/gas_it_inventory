<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('stocks', function (Blueprint $table) {
                $table->foreign('item_name')
                      ->references('item_name')
                      ->on('items')
                      ->onUpdate('cascade')
                      ->onDelete('restrict');

                $table->foreign('category_name')
                      ->references('category_name')
                      ->on('items')
                      ->onUpdate('cascade')
                      ->onDelete('restrict');
            });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('stocks', function (Blueprint $table) {
                $table->dropForeign(['item_name']);
                $table->dropForeign(['category_name']);
            }); 
    }
}
