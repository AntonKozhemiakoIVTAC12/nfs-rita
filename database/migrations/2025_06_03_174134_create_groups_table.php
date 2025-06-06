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
        Schema::create('groups', function (Blueprint $table) {
            $table->id('group_id');
            $table->string('group_name')->unique();
            $table->integer('course');
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('groups');
    }
};
