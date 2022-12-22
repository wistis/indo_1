<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('posts', function(Blueprint $table) {
      $table->id();

      $table->string('title')->nullable();
      $table->string('description')->nullable();
      $table->string('slug')->nullable();
      $table->string('h1')->nullable();
      $table->integer('author_id')->nullable();
      $table->string('text_short',500)->nullable();
      $table->text('text')->nullable();
      $table->integer('lang_id')->nullable();
      $table->string('image')->nullable();
      $table->integer('sort')->nullable();
      $table->integer('footer')->nullable();

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('posts');
  }
};
