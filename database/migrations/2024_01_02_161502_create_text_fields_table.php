<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('text_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained();
            $table->string('label');
            $table->text('content')->nullable();
            $table->integer('recommended_length')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('text_fields');
    }
}