<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents("database/seeders/data/route_data.json");
        $items = json_decode($data, true);
        $seed = [];
        foreach ($items as $i) {
            foreach ($i as $p) {
                array_push($seed, [
                    'route_id' => $p['route_id'],
                    'calendar_id' => $p['calendar_id'],
                    'vinculation_route' => $p['vinculation_route'],
                    'route_circular' => $p['route_circular'],
                    'date_init' => $p['date_init'],
                    'date_finish' => $p['date_finish'],
                    'mon' => $p['mon'],
                    'tue' => $p['tue'],
                    'wed' => $p['wed'],
                    'thu' => $p['thu'],
                    'fri' => $p['fri'],
                    'sat' => $p['sat'],
                    'sun' => $p['sun'],
                    'updated_at' => $p['updated_at'],
                    'created_at' => $p['created_at']
                ]);
            }
        }
        DB::table('routes_data')->insert($seed);
    }
}
