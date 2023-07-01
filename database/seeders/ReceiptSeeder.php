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
            ]
        ]);
    }
}
