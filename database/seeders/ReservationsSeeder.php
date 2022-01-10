<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents("database/seeders/data/reservations.json");
        $items = json_decode($data, true);
        $seed = [];
        foreach ($items as $i) {
            foreach ($i as $p) {
                array_push($seed, [
                    'user_plan_id' => $p['user_plan_id'],
                    'route_id' => $p['route_id'],
                    'track_id' => $p['track_id'],
                    'reservation_start' => $p['reservation_start'],
                    'reservation_end' => $p['reservation_end'],
                    'route_stop_origin_id' => $p['route_stop_origin_id'],
                    'route_stop_destination_id' => $p['route_stop_destination_id'],
                    'created_at' => $p['created_at'],
                    'updated_at' => $p['updated_at'],
                    'deleted_at' => $p['deleted_at'],
                ]);
            }
        }
        DB::table('reservations')->insert($seed);
    }
}
