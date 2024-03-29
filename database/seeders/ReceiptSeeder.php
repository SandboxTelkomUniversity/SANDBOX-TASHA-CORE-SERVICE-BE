<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Transaction : Campaign active
        DB::table('receipts')->insert([
            [
                'id' => 'ee931aab-2b72-4df0-bef1-5e54afabdc4a',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '968572e2-05f1-4f07-b8f3-18729c8dddc0',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Transaction : Campaign running
        DB::table('receipts')->insert([
            [
                'id' => '7994d8f2-f5da-4796-99e1-cbb6a9f970bc',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3d92e611-07b5-45dd-9965-50fd8ca50803',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Transaction : Campaign done
        DB::table('receipts')->insert([
            [
                'id' => 'febe7a0b-14db-4967-bd25-701ff538616b',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '10c60b68-47eb-495b-831c-022fbf75c658',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Payment : Campaign Running
        DB::table('receipts')->insert([
            [
                'id' => 'e37d60e8-90b6-4b95-a588-4dc94a0934cb',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Payment : Campaign Done
        DB::table('receipts')->insert([
            [
                'id' => '36bf995f-c165-42c5-8cdb-5605d66baad7',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '7b1b20fa-8bca-45a6-9319-f42756bbc7de',
                'receipt_url' => 'https://assets-a1.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
