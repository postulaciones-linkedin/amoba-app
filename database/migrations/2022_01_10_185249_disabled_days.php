<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DisabledDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disabled_days', function (Blueprint $table) {
            $table->id();
            $table->integer('calendar_id')->nullable(false);
            $table->date('day');
            $table->boolean('enabled')->default(0);
            $table->date('updated_at')->nullable(true);
            $table->date('created_at');
        });
        DB::update("ALTER TABLE disabled_days AUTO_INCREMENT = 2319;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disabled_days');
    }
}
