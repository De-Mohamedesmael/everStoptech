<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->text('translations')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('sku');
            $table->string('multiple_colors')->nullable();
            $table->string('multiple_sizes')->nullable();
            $table->boolean('is_service')->default(0);
            $table->string('barcode_type');
            $table->integer('alert_quantity')->nullable();
            $table->decimal('other_cost', 15, 4)->default(0);
            $table->decimal('purchase_price', 15, 4);
            $table->decimal('sell_price', 15, 4);
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->string('tax_method')->nullable();
            $table->boolean('show_to_customer')->default(1);
            $table->text('show_to_customer_types')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('automatic_consumption')->default(0);
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('products');
    }
}
