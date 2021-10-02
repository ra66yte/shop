<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->nullable(false)->unique('email');
            $table->timestamp('email_verified_at')->nullable(true);
            $table->string('password', 255)->nullable(false);
            $table->string('first_name', 60)->nullable(false);
            $table->string('last_name', 60)->nullable(false);
            $table->string('middle_name', 60)->nullable(true);
            $table->string('remember_token', 100)->nullable(true);
            $table->enum('sex', ['male', 'female', 'other'])->nullable(true);
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
        //
    }
}
