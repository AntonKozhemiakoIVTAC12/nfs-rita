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
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('email')->unique()->after('department')->nullable();
            $table->timestamp('email_verified_at')->nullable()->after('email');
            $table->string('password')->after('email_verified_at')->nullable();
            $table->rememberToken()->after('password');
        });
    }

    public function down():void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn(['email', 'email_verified_at', 'password', 'remember_token']);
        });
    }
};
