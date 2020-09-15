<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{ 
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('photo');
            $table->string('photo_rec');
            $table->boolean('is_activated')->default(0);
            $table->boolean('is_banned')->default(0);
            $table->boolean('is_private')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->string('hash')->nullable()->default(null);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
