<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents("database/seeders/data/services.json");
        $items = json_decode($data, true);
        $seed = [];
        foreach ($items as $i) {
            foreach ($i as $p) {
                array_push($seed, [
                    'external_id' => $p['external_id'],
                    'external_budget_id' => $p['external_budget_id'],
                    'external_route_id' => $p['external_route_id'],
                    'track_id' => $p['track_id'],
                    'name' => $p['name'],
                    'notes' => $p['notes'],
                    'timestamp' => $p['timestamp'],
                    'arrival_address' => $p['arrival_address'],
                    'arrival_timestamp' => $p['arrival_timestamp'],
                    'departure_address' => $p['departure_address'],
                    'departure_timestamp' => $p['departure_timestamp'],
                    'capacity' => $p['capacity'],
                    'confirmed_pax_count' => $p['confirmed_pax_count'],
                    'reported_departure_timestamp' => $p['reported_departure_timestamp'],
                    'reported_departure_kms' => $p['reported_departure_kms'],
                    'reported_arrival_timestamp' => $p['reported_arrival_timestamp'],
                    'reported_arrival_kms' => $p['reported_arrival_kms'],
                    'reported_vehicle_plate_number' => $p['reported_vehicle_plate_number'],
                    'status' => $p['status'],
                    'status_info' => $p['status_info'],
                    'reprocess_status' => $p['reprocess_status'],
                    'return' => $p['return'],
                    'created' => $p['created'],
                    'modified' => $p['modified'],
                    'synchronized_downstream' => $p['synchronized_downstream'],
                    'synchronized_upstream' => $p['synchronized_upstream'],
                    'province_id' => $p['province_id'],
                    'sale_tickets_drivers' => $p['sale_tickets_drivers'],
                    'notes_drivers' => $p['notes_drivers'],
                    'itinerary_drivers' => $p['itinerary_drivers'],
                    'cost_if_externalized' => $p['cost_if_externalized']
                ]);
            }
        }
        DB::table('services')->insert($seed);
    }
}
