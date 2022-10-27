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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('mykid');
            $table->string('class');
            $table->string('gender');
            $table->string('citizenship');
            $table->string('address');
            $table->string('G1_name');
            $table->string('G1_relation');
            $table->string('G1_phonenum');
            $table->integer('G1_income',false,false);
            $table->string('G2_name');
            $table->string('G2_relation');
            $table->string('G2_phonenum');
            $table->integer('G2_income',false,false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
