<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            [
                'id' => 'ec2186f3-3677-45ee-8473-d8718b96b9a3',
                'id_campaign' => 'e677c205-4e40-41c7-ba76-17c120360227',
                'id_user' => 'a08a311b-1753-4d07-a01e-11c84986e38c',
                'id_receipt' => 'ee931aab-2b72-4df0-bef1-5e54afabdc4a',
                'investor_amount' => 200000,
                'sukuk' => 20,
                'service_fee' => 10000,
                'status' => 'APPROVED',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3313c87c-e8eb-4b97-a290-12f0e86838a3',
                'id_campaign' => 'e677c205-4e40-41c7-ba76-17c120360227',
                'id_user' => '0b5ce901-822e-4965-b88d-1b868450e306',
                'id_receipt' => '968572e2-05f1-4f07-b8f3-18729c8dddc0',
                'investor_amount' => 300000,
                'sukuk' => 30,
                'service_fee' => 10000,
                'status' => 'APPROVED',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Campaign running
        DB::table('transactions')->insert([
        [
            'id' => 'd0630376-e1df-4b22-9741-87fd4ea16782',
            'id_campaign' => '4aa0b5a1-73c4-402f-98e7-a3ce57668ebb',
            'id_user' => 'a08a311b-1753-4d07-a01e-11c84986e38c',
            'id_receipt' => '7994d8f2-f5da-4796-99e1-cbb6a9f970bc',
            'investor_amount' => 450000,
            'sukuk' => 45,
            'service_fee' => 10000,
            'status' => 'APPROVED',
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => false,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 'c68c9fe7-0c77-4208-91c7-834dd53a4a62',
            'id_campaign' => '4aa0b5a1-73c4-402f-98e7-a3ce57668ebb',
            'id_user' => '0b5ce901-822e-4965-b88d-1b868450e306',
            'id_receipt' => '3d92e611-07b5-45dd-9965-50fd8ca50803',
            'investor_amount' => 550000,
            'sukuk' => 55,
            'service_fee' => 10000,
            'status' => 'APPROVED',
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => false,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);

    //campaign done
    DB::table('transactions')->insert([
        [
            'id' => 'c8be672a-52e0-4d10-ae1f-f0f5ba1150e0',
            'id_campaign' => '07e96b54-4045-4103-8851-5b65204f0bcd',
            'id_user' => 'a08a311b-1753-4d07-a01e-11c84986e38c',
            'id_receipt' => 'febe7a0b-14db-4967-bd25-701ff538616b',
            'investor_amount' => 350000,
            'sukuk' => 35,
            'service_fee' => 10000,
            'status' => 'APPROVED',
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => false,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],

        [
            'id' => '3b3f93fe-9b3d-4c83-82eb-717982041ace',
            'id_campaign' => '07e96b54-4045-4103-8851-5b65204f0bcd',
            'id_user' => '0b5ce901-822e-4965-b88d-1b868450e306',
            'id_receipt' => '10c60b68-47eb-495b-831c-022fbf75c658',
            'investor_amount' => 650000,
            'sukuk' => 65,
            'service_fee' => 10000,
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
