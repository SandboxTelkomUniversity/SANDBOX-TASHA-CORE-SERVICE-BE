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
                'is_deleted' => true,
                'version' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Campaign Running
        DB::table('payments')->insert([
            [
                'id' => '2f3fb891-fd31-4e83-b66e-6c0a2eaf5bcb',
                'id_user' => 'c2169bb5-43d3-4abd-af69-ffbb1303b1de',
                'id_receipt' => 'e37d60e8-90b6-4b95-a588-4dc94a0934cb',
                'amount' => 750000,
                'status' => 'APPROVED',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Campaign Done
        DB::table('payments')->insert([
            [
                'id' => 'd91a6b95-70b0-483c-b290-da64cb7744df',
                'id_user' => 'c2169bb5-43d3-4abd-af69-ffbb1303b1de',
                'id_receipt' => '36bf995f-c165-42c5-8cdb-5605d66baad7',
                'amount' => 750000,
                'status' => 'APPROVED',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '331aa0d7-7076-40dc-8c43-2c2b9183b167',
                'id_user' => 'c2169bb5-43d3-4abd-af69-ffbb1303b1de',
                'id_receipt' => '7b1b20fa-8bca-45a6-9319-f42756bbc7de',
                'amount' => 750000,
                'status' => 'APPROVED',
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
