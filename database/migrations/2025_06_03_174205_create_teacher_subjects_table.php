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
        Schema::create('teacher_subjects', function (Blueprint $table) {
            $table->foreignId('teacher_id')->constrained('teachers', 'teacher_id')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects', 'subject_id')->cascadeOnDelete();
            $table->primary(['teacher_id', 'subject_id']);
        });
    }

    public function down():void
    {
        Schema::dropIfExists('teacher_subjects');
    }
};
