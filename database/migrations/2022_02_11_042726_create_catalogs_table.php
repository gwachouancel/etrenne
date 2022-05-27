<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string("ref_catalog")->unique();
            $table->string('name');
            $table->string('type');
            $table->enum('status', ['approuved', 'rejected'])->nullable();
            $table->string('path')->unique();

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references("id")->on('suppliers');         
            $table->unsignedBigInteger('filiale_id');
            $table->foreign('filiale_id')->references("id")->on('filiales');
            
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
        Schema::dropIfExists('catalogs');
    }
}
