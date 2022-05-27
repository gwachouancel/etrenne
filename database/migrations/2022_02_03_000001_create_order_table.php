<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['production_start', 'production_end', 'to_transit', 'order_sent', 'boarding'])->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references("id")->on('users');
            $table->unsignedBigInteger('filiale_id');
            $table->foreign('filiale_id')->references("id")->on('filiales');
            $table->boolean('isblocked')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
