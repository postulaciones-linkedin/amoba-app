<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->longtext('picture')->nullable(true);
            $table->string('email');
            $table->string('password')->nullable(true);
            $table->string('remember_token')->nullable(true);
            $table->date('last_online')->nullable(true);
            $table->string('verification_code')->nullable(true);
            $table->string('new_email')->nullable(true);
            $table->integer('status');
            $table->integer('first');
            $table->string('last_accept_date')->nullable(true);
            $table->date('created')->nullable(true);
            $table->date('modified')->nullable(true);
            $table->string('company_contact')->nullable(true);
            $table->bigInteger('credits')->nullable(true);
            $table->integer('first_trip');
            $table->integer('incomplete_profile');
            $table->string('token_auto_login')->nullable(true);
            $table->string('user_vertical')->nullable(true);
            $table->integer('language_id')->nullable(true);
            $table->integer('no_registered');
            $table->date('deleted_at')->nullable(true);
            $table->boolean('phone_verify')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
