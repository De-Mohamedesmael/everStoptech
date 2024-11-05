<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchasePriceDependsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_', function (Blueprint $table) {
            $table->double('selling_price_depends')->nullable();
            $table->double('purchase_price_depends')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_', function (Blueprint $table) {
            $table->dropColumn('selling_price_depends');
            $table->dropColumn('purchase_price_depends');
        });
    }
}
