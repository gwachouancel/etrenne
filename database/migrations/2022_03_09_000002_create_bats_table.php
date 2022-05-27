<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bats', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['approuved', 'rejected', 'pending'])->default('pending');
            //$table->unsignedBigInteger('orderitem_id');
            //$table->foreign('orderitem_id')->references("id")->on('orderitems');
            $table->string('ref_product');
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
        Schema::dropIfExists('bats');
    }
}
