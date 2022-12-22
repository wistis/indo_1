<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('ads', function(Blueprint $table) {
      $table->id();
      $table->integer('location_id')->nullable();
      $table->integer('company_id')->nullable();
      $table->string('name_en')->nullable();
      $table->integer('salary_from')->nullable();
      $table->integer('salary_to')->nullable();
      $table->date('public_at')->nullable();
      $table->integer('expiries_from')->nullable();
      $table->integer('expiries_to')->nullable();
      $table->string('expiries_type')->nullable();
      $table->text('description_en')->nullable();
      $table->text('skills_en')->nullable();


      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('ads');
  }
};
