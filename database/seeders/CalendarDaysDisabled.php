<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarDaysDisabled extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents("database/seeders/data/calendar_days_disabled.json");
        $items = json_decode($data, true);
        $seed = [];
        foreach ($items as $i) {
            foreach ($i as $p) {
                array_push($seed, [
                    'calendar_id' => $p['calendar_id'],
                    'day' => $p['day'],
                    'enabled' => $p['enabled'],
                    'updated_at' => $p['updated_at'],
                    'created_at' => $p['created_at']
                ]);
            }
        }
        DB::table('disabled_days')->insert($seed);
    }
}
