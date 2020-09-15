<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doc_id');
            $table->date('day');
            $table->timestamp('pay_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('status')->default(0);
            $table->boolean('moder')->default(0);
            $table->string('hash');
            $table->timestamps();
            
            $table->foreign('doc_id')->references('id')->on('docs')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
