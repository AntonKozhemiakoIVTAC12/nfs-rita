<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->timestamp('timestamp')->useCurrent();

            $table->foreignId('lesson_id')->constrained('lessons', 'lesson_id')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students', 'student_id')->cascadeOnDelete();

            $table->unique(['lesson_id', 'student_id']);
        });
    }

    public function down():void
    {
        Schema::dropIfExists('attendance');
    }
};
