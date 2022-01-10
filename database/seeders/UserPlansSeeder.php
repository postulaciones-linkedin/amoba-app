<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents("database/seeders/data/user_plans.json");
        $items = json_decode($data, true);
        $seed = [];
        foreach ($items as $i) {
            foreach ($i as $p) {
                array_push($seed, [
                    'user_id' => $p['user_id'],
                    'currency_id' => $p['currency_id'],
                    'next_user_plan_id' => $p['next_user_plan_id'],
                    'start_timestamp' => $p['start_timestamp'],
                    'end_timestamp' => $p['end_timestamp'],
                    'renewal_timestamp' => $p['renewal_timestamp'],
                    'renewal_price' => $p['renewal_price'],
                    'requires_invoice' => $p['requires_invoice'],
                    'status' => $p['status'],
                    'created' => $p['created'],
                    'modified' => $p['modified'],
                    'financiation' => $p['financiation'],
                    'status_financiation' => $p['status_financiation'],
                    'language' => $p['language'],
                    'nif' => $p['nif'],
                    'business_name' => $p['business_name'],
                    'pending_payment' => $p['pending_payment'],
                    'date_max_payment' => $p['date_max_payment'],
                    'proxim_start_timestamp' => $p['proxim_start_timestamp'],
                    'proxim_end_timestamp' => $p['proxim_end_timestamp'],
                    'proxim_renewal_timestamp' => $p['proxim_renewal_timestamp'],
                    'proxim_renewal_price' => $p['proxim_renewal_price'],
                    'credits_return' => $p['credits_return'],
                    'company_id' => $p['company_id'],
                    'cancel_employee' => $p['cancel_employee'],
                    'force_renovation' => $p['force_renovation'],
                    'date_canceled' => $p['date_canceled'],
                    'amount_confirm_canceled' => $p['amount_confirm_canceled'],
                    'credit_confirm_canceled' => $p['credit_confirm_canceled'],
                    'cost_center_id' => $p['cost_center_id']
                ]);
            }
        }
        DB::table('user_plans')->insert($seed);
    }
}
