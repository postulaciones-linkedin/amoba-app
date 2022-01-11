<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UserPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(true);
            $table->integer('currency_id');
            $table->integer('next_user_plan_id')->nullable(true);
            $table->date('start_timestamp')->nullable(true);
            $table->date('end_timestamp')->nullable(true);
            $table->date('renewal_timestamp')->nullable(true);
            $table->float('renewal_price')->nullable(true);
            $table->bigInteger('requires_invoice')->nullable(true);
            $table->integer('status')->default(0);
            $table->date('created')->nullable(true);
            $table->date('modified')->nullable(true);
            $table->integer('financiation');
            $table->string('language');
            $table->string('nif');
            $table->string('business_name');
            $table->integer('pending_payment');
            $table->date('date_max_payment')->nullable(true);
            $table->date('proxim_start_timestamp')->nullable(true);
            $table->date('proxim_end_timestamp')->nullable(true);
            $table->date('proxim_renewal_timestamp')->nullable(true);
            $table->bigInteger('proxim_renewal_price')->nullable(true);
            $table->float('credits_return');
            $table->integer('company_id');
            $table->boolean('cancel_employee')->default(0);
            $table->boolean('force_renovation')->default(0);
            $table->date('date_canceled')->nullable(true);
            $table->float('amount_confirm_canceled')->nullable(true);
            $table->float('credit_confirm_canceled')->nullable(true);
            $table->integer('cost_center_id');
            $table->boolean('status_financiation')->default(0);
        });
        DB::update("ALTER TABLE user_plans AUTO_INCREMENT = 52;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_plans');
    }
}
