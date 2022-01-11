<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Services extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('external_id');
            $table->string('external_budget_id');
            $table->string('external_route_id');
            $table->integer('track_id')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('notes')->nullable(true);
            $table->timestamp('timestamp');
            $table->string('arrival_address');
            $table->string('arrival_timestamp');
            $table->string('departure_address');
            $table->date('departure_timestamp');
            $table->integer('capacity');
            $table->integer('confirmed_pax_count');
            $table->date('reported_departure_timestamp')->nullable(true);
            $table->integer('reported_departure_kms')->nullable(true);
            $table->date('reported_arrival_timestamp')->nullable(true);
            $table->integer('reported_arrival_kms')->nullable(true);
            $table->integer('reported_vehicle_plate_number')->nullable(true);
            $table->integer('status');
            $table->string('status_info');
            $table->boolean('reprocess_status')->default(0);
            $table->boolean('return')->default(0);
            $table->date('created');
            $table->date('modified')->nullable(true);
            $table->boolean('synchronized_downstream')->default(0)->nullable(true);
            $table->boolean('synchronized_upstream')->default(0)->nullable(true);
            $table->integer('province_id');
            $table->integer('sale_tickets_drivers');
            $table->string('notes_drivers')->nullable(true);
            $table->longText('itinerary_drivers');
            $table->string('cost_if_externalized')->nullable(true);
        });
        DB::update("ALTER TABLE services AUTO_INCREMENT = 26257972;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
