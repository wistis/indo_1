<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('translates', function(Blueprint $table) {
      $table->id();
      $table->string('vkey')->nullable();
      $table->string('vvalue')->nullable();
      $table->integer('lang_id')->nullable();


      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('translates');
  }
};
