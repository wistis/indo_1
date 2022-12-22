<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('langs', function(Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->string('code')->nullable();
      $table->integer('sort')->nullable();
      $table->integer('is_default')->nullable();



      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('langs');
  }
};
