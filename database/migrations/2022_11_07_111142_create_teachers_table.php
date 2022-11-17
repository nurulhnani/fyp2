<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status');
            $table->string('name');
            $table->string('nric');
            $table->string('gender');
            $table->string('email');
            $table->string('position');
            $table->unsignedBigInteger('classlist_id')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->string('image_path');
            $table->string('additional_Info')->nullable();
            $table->foreign('classlist_id')->references('id')->on('classlists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
