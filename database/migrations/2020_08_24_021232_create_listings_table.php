<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('space_type');
            $table->string('space_address');
            $table->string('space_location');
            $table->date('available_from');
            $table->integer('rent');
            $table->integer('user_id');
            $table->string('payer_gender')->nullable();
            $table->string('space_for');
            $table->integer('rating')->default('1');
            $table->string('duration')->nullable();
            $table->string('bedroom_type')->nullable();
            $table->mediumText('about_property');
            $table->longText('images')->default('empty.jpg');
            $table->mediumText('about_cohabitation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
