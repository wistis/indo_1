<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('salaries', function(Blueprint $table) {
      $table->id();
      $table->string('name_en')->nullable();
      $table->integer('value')->nullable();
      $table->string('znak')->nullable();



      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('salaries');
  }
};
