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
        Schema::create('profile_requests', function (Blueprint $table) {
            $table->id();
            $table->longText('changes');
            // $table->string('address')->nullable();
            // $table->string('G1_name')->nullable();
            // $table->string('G1_relation')->nullable();
            // $table->string('G1_phonenum')->nullable();
            // $table->integer('G1_income',false,false)->nullable();
            // $table->string('G2_name')->nullable();
            // $table->string('G2_relation')->nullable();
            // $table->string('G2_phonenum')->nullable();
            // $table->integer('G2_income',false,false)->nullable();
            // $table->string('image_path')->nullable();
            $table->string('student_mykid');
            $table->string('status');
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
        Schema::dropIfExists('profile_requests');
    }
};
