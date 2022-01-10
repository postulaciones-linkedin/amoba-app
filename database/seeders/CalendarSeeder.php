<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendar')->insert(
            [
                [
                    'calendar_id' => NULL,
                    'name' => "Catalunya",
                    'updated_at' => '2020-01-14 13:42:25',
                    'created_at' => '2020-01-14 13:42:25'
                ],
                [
                    "calendar_id" => null,
                    "name" => "test calendar",
                    "updated_at" => "2021-05-03 12:29:46",
                    "created_at" => "2021-05-03 12:29:46"
                ]
            ]
        );
    }
}
