<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiKeysTable extends Migration
{
    public function up()
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id(); 
            $table->uuid('uuid')->unique(); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('name'); 
            $table->string('key')->unique(); 
            $table->timestamps(); 

          
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_keys');
    }
}
