<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'id' => 'd15647c2-8ff3-4d08-9c7c-fc2a8e9544f1',
                'id_user' => 'c2169bb5-43d3-4abd-af69-ffbb1303b1de',
                'id_receipt' => 'ee931aab-2b72-4df0-bef1-5e54afabdc4a',
                'amount' => 100000,
                'status' => 'WAITING_VERIFICATION',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
