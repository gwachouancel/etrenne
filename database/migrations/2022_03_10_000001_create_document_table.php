<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('mime');
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('path')->unique();
            $table->enum('type', ['bat', 'bill','expedition','rib'])->nullable();
            $table->unsignedBigInteger('type_id');
            $table->enum('status', ['approuved', 'rejected'])->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references("id")->on('users');
            $table->unsignedBigInteger('filiale_id')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
