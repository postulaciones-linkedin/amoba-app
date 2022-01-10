<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents("database/seeders/data/users.json");
        $items = json_decode($data, true);
        $seed = [];
        foreach ($items as $i) {
            foreach ($i as $p) {
                array_push($seed, [
                    'first_name' => $p['first_name'],
                    'last_name' => $p['last_name'],
                    'phone_number' => $p['phone_number'],
                    'picture' => $p['picture'],
                    'email' => $p['email'],
                    'password' => $p['password'],
                    'remember_token' => $p['remember_token'],
                    'last_online' => $p['last_online'],
                    'verification_code' => $p['verification_code'],
                    'new_email' => $p['new_email'],
                    'status' => $p['status'],
                    'first' => $p['first'],
                    'last_accept_date' => $p['last_accept_date'],
                    'created' => $p['created'],
                    'modified' => $p['modified'],
                    'company_contact' => $p['company_contact'],
                    'credits' => $p['credits'],
                    'first_trip' => $p['first_trip'],
                    'incomplete_profile' => $p['incomplete_profile'],
                    'phone_verify' => $p['phone_verify'],
                    'token_auto_login' => $p['token_auto_login'],
                    'user_vertical' => $p['user_vertical'],
                    'language_id' => $p['language_id'],
                    'no_registered' => $p['no_registered'],
                    'deleted_at' => $p['deleted_at']
                ]);
            }
        }
        DB::table('user')->insert($seed);
    }
}
