<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocsTable extends Migration
{
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');  // Название документа
            $table->string('univer');  // Университет
            $table->text('comment')->nullable()->default(null);  // Комментарий
            $table->string('subject');  // Предмет
            $table->string('prep')->default('');  // Имя преподавателя
            $table->string('group');  // Номер направления
            $table->unsignedSmallInteger('year');  // Номер курса
            $table->boolean('semester'); // Семестр (0 - осенний, 1 - весенний)
            $table->decimal('price')->unsigned()->nullable()->default(null);  // Стоимость
            $table->unsignedBigInteger('views')->default(0); // Кол-во просмотров
            $table->boolean('type');  // (0 - предложение, 1 - спрос)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('docs');
    }
}
