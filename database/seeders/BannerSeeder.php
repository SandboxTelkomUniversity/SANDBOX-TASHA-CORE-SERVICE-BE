<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
                'id' => 'f88fb830-5900-4e7e-90fe-b54d2686aef6',
                'name' => 'Banner 1',
                'url' => 'https://assets.jatimnetwork.com/crop/0x0:0x0/750x500/webp/photo/2023/02/03/1223582901.jpeg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('banners')->insert([
            [
                'id' => 'a8d4d036-197b-47d7-a3d6-bfbca992855d',
                'name' => 'Banner 2',
                'url' => 'https://assets.jatimnetwork.com/crop/0x0:0x0/750x500/webp/photo/2023/02/03/1223582901.jpeg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('banners')->insert([
            [
                'id' => 'b3c4e7c1-820b-4a61-b5b1-3e41f59bfa92',
                'name' => 'Banner 3',
                'url' => 'https://assets.jatimnetwork.com/crop/0x0:0x0/750x500/webp/photo/2023/02/03/1223582901.jpeg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('banners')->insert([
            [
                'id' => 'e1181f12-3d72-4a1d-977e-6c7517368b1f',
                'name' => 'Banner 4',
                'url' => 'https://assets.jatimnetwork.com/crop/0x0:0x0/750x500/webp/photo/2023/02/03/1223582901.jpeg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('banners')->insert([
            [
                'id' => '3d9c7815-1799-43f7-8dd6-13fe6c345afe',
                'name' => 'Banner 5',
                'url' => 'https://assets.jatimnetwork.com/crop/0x0:0x0/750x500/webp/photo/2023/02/03/1223582901.jpeg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('banners')->insert([
            [
                'id' => '288536a4-fa8d-41f7-b1c0-5ed9ee838748',
                'name' => 'Banner 6',
                'url' => 'https://assets.jatimnetwork.com/crop/0x0:0x0/750x500/webp/photo/2023/02/03/1223582901.jpeg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('banners')->insert([
            [
                'id' => 'eaa70008-ee20-4848-9bb0-564a0f9aa3da',
                'name' => 'Banner 7',
                'url' => 'https://assets.jatimnetwork.com/crop/0x0:0x0/750x500/webp/photo/2023/02/03/1223582901.jpeg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('banners')->insert([
            [
                'id' => '4dfd5e5f-ab19-4c10-8c89-4055370d8c15',
                'name' => 'Banner 8',
                'url' => 'https://assets.jatimnetwork.com/crop/0x0:0x0/750x500/webp/photo/2023/02/03/1223582901.jpeg',
                'updated_by' => 'system',
                'created_by' => 'system',
                'is_deleted' => 0,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
