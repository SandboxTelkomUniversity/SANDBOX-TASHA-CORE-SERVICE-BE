<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignReportGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Campaign Running
        DB::table('campaign_report_groups')->insert([
            [
                'id' => 'ed4ee7d3-c623-419a-96c0-a9cc9ad7af5b',
                'id_campaign_report' => 'bafc7c42-27a9-485e-9527-005951aae1ef',
                'id_campaign_report_detail' => 'your_uuid_value', // TODO
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO (TOTAL ROW CSV)
        ]);

        // Campaign Done Part 1
        DB::table('campaign_report_groups')->insert([
            [
                'id' => 'fd0f9b36-e858-457f-b8e1-4652b6fe1727',
                'id_campaign_report' => 'cbd8db3d-3cd4-4730-aee9-3f0c4cd13e47',
                'id_campaign_report_detail' => 'your_uuid_value', // TODO
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '137f1ad1-f79b-4e1f-9040-9787a02a6e5b',
                'id_campaign_report' => 'cbd8db3d-3cd4-4730-aee9-3f0c4cd13e47',
                'id_campaign_report_detail' => 'your_uuid_value', // TODO
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO (TOTAL ROW CSV)
        ]);

        // Campaign Done Part 2
        DB::table('campaign_report_groups')->insert([
            [
                'id' => 'f4970d3f-b7bc-4f39-87e1-094685fc3228',
                'id_campaign_report' => '340c2b31-c6c7-449b-93b0-b059057f2e7c',
                'id_campaign_report_detail' => 'your_uuid_value', // TODO
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'a411677d-363b-4716-8686-0f4362c85099',
                'id_campaign_report' => '340c2b31-c6c7-449b-93b0-b059057f2e7c',
                'id_campaign_report_detail' => 'your_uuid_value', // TODO
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO (TOTAL ROW CSV)
        ]);
    }
}
