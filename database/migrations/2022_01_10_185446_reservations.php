<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Reservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_plan_id');
            $table->integer('route_id');
            $table->integer('track_id')->nullable(true);
            $table->date('reservation_start');
            $table->date('reservation_end');
            $table->integer('route_stop_origin_id');
            $table->integer('route_stop_destination_id');
            $table->boolean('enabled')->default(0);
            $table->date('updated_at')->nullable(true);
            $table->timestamp('created_at');
            $table->date('deleted_at')->nullable(true);
        });
        DB::update("ALTER TABLE reservations AUTO_INCREMENT = 213;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
