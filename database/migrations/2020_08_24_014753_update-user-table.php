<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phoneNo')->nullable();
            $table->string('profile_pic_filename')->default('profile.png');
            $table->string('profile_pic_url')->default(env('APP_URL').'storage/uploads/images/profile.png');
            $table->string('location');
            $table->integer('age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropIfExists('phoneNo');
            Schema::dropIfExists('profile_pic_filename');
            Schema::dropIfExists('profile_pic_url');
            Schema::dropIfExists('location');
            Schema::dropIfExists('age');
        });
    }
}
