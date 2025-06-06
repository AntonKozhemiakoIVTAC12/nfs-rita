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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('nfc_id')->unique();
            $table->string('full_name');
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('students');
    }
};
