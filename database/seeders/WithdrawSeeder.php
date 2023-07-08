<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WithdrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Campaign process
        DB::table('withdraws')->insert([
            [
                'id' => '7a13b7d4-f55a-4c6f-972a-dc5adb05770c',
                'id_user' => 'c2169bb5-43d3-4abd-af69-ffbb1303b1de',
                'id_campaign' => '153afbca-f0db-48fc-81b7-110acf0c9cbc',
                'amount' => 1000000,
                'registration_fee' => 100000,
                'service_fee' => 10000,
                'status' => 'WAITING_VERIFICATION',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '1627d995-c887-4d6b-bc2a-697a91255a9c',
                'id_user' => 'c2169bb5-43d3-4abd-af69-ffbb1303b1de',
                'id_campaign' => '153afbca-f0db-48fc-81b7-110acf0c9cbc',
                'amount' => 1000000,
                'registration_fee' => 100000,
                'service_fee' => 10000,
                'status' => 'REJECTED',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Campaign running
        DB::table('withdraws')->insert([
            [
                'id' => '2ec4ff37-92c2-4b8b-89c8-cd6993af5246',
                'id_user' => 'c2169bb5-43d3-4abd-af69-ffbb1303b1de',
                'id_campaign' => '4aa0b5a1-73c4-402f-98e7-a3ce57668ebb',
                'amount' => 1000000,
                'registration_fee' => 100000,
                'service_fee' => 10000,
                'status' => 'APPROVED',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Campaign Done
        DB::table('withdraws')->insert([
            [
                'id' => '7cf498f1-bd22-478b-aac6-7067aaebaee1',
                'id_user' => 'c2169bb5-43d3-4abd-af69-ffbb1303b1de',
                'id_campaign' => '07e96b54-4045-4103-8851-5b65204f0bcd',
                'amount' => 1000000,
                'registration_fee' => 100000,
                'service_fee' => 10000,
                'status' => 'APPROVED',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

    }
}
