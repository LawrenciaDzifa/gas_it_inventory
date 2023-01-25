<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToStockHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            $table->enum('type', ['Initial stock', 'Restock'])->default('Initial stock')->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
