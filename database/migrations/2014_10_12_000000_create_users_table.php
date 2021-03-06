<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phoneNo')->nullable();
            $table->string('profile_pic_filename')->default('profile.png');
            $table->boolean('reveal_contact')->default(true);
            $table->string('profile_pic_url')->default(env('APP_URL').'storage/uploads/images/profile.png');
            $table->string('location')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('id_verified_at')->nullable();
            $table->mediumText('bio')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
