<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references("id")->on('orders');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references("id")->on('suppliers');
            $table->string('ref_catalog');
            $table->string('ref_product');
            $table->string('type');
            $table->enum('category', ['gift','agenda']);
            $table->string('product_name');
            $table->integer('page');
            $table->integer('quantity');
            $table->float('price', 10, 2);
            $table->string('currency');
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
        Schema::dropIfExists('orderitems');
    }
}
