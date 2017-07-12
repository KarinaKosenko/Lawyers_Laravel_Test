<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path', 255);
            $table->unsignedBigInteger('size');
            $table->string('oldname', 255);
            $table->string('ext', 10)->nullable();
            $table->string('mime', 50);
            $table->tinyInteger('user_id');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
