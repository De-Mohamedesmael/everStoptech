<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumptionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumption_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('raw_material_id')->comment('products table id as raw material');
            $table->decimal('amount_used', 15, 4)->default(0);
            $table->foreign('raw_material_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('consumption_products');
    }
}
