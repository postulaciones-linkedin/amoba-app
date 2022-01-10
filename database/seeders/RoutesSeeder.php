<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents("database/seeders/data/routes.json");
        $items = json_decode($data, true);
        $seed = [];
        foreach ($items as $i) {
            foreach ($i as $p) {
                array_push($seed, [
                    'external_id' => $p['external_id'],
                    'invitation_code' => $p['invitation_code'],
                    'title' => $p['title'],
                    'start_timestamp' => $p['start_timestamp'],
                    'end_timestamp' => $p['end_timestamp']
                ]);
            }
        }
        DB::table('routes')->insert($seed);
    }
}
