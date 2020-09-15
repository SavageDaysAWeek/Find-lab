<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifiesTable extends Migration
{
    public function up()
    {
        Schema::create('notifies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from_user');
            $table->unsignedBigInteger('to_user');
            $table->unsignedBigInteger('doc_id');
            $table->date('date');

            $table->foreign('from_user')->references('id')->on('users');
            $table->foreign('to_user')->references('id')->on('users');
            $table->foreign('doc_id')->references('id')->on('docs');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('notifies');
    }
}
