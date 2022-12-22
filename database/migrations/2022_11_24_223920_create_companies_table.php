<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('companies', function(Blueprint $table) {
      $table->id();
      $table->string('name_en')->nullable();
      $table->string('image')->nullable();


      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('companies');
  }
};
