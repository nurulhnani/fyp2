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
        // 'student_id','health_history','description','medication_allergies','medications_now_taking','chicken_pox','measles','mumps','present_health'
        Schema::create('healths', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('health_history')->nullable();
            $table->string('description')->nullable();
            $table->string('medication_allergies')->nullable();
            $table->string('medications_now_taking')->nullable();
            $table->string('chicken_pox')->nullable();
            $table->string('measles')->nullable();
            $table->string('mumps')->nullable();
            $table->string('present_health')->nullable();
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
        Schema::dropIfExists('healths');
    }
};
