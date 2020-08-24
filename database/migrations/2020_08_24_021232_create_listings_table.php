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
            $table->string('available_form');
            $table->integer('rent');
            $table->integer('user_id');
            $table->string('payer_gender');
            $table->integer('rating');
            $table->string('bedroom_type');
            $table->string('slug');
            $table->mediumText('about_property');
            $table->mediumText('about_cohabitation');
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
