<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Campaign Running
        DB::table('campaign_reports')->insert([
            [
                'id' => 'bafc7c42-27a9-485e-9527-005951aae1ef',
                'id_campaign' => '4aa0b5a1-73c4-402f-98e7-a3ce57668ebb',
                'id_payment' => '2f3fb891-fd31-4e83-b66e-6c0a2eaf5bcb',
                'document_name' => 'document_name_here', // TODO
                'document_url' => 'document_url_here', // TODO
                'is_exported' => true,
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Campaign Done
        DB::table('campaign_reports')->insert([
            [
                'id' => 'cbd8db3d-3cd4-4730-aee9-3f0c4cd13e47',
                'id_campaign' => '07e96b54-4045-4103-8851-5b65204f0bcd',
                'id_payment' => 'd91a6b95-70b0-483c-b290-da64cb7744df',
                'document_name' => 'document_name_here', // TODO
                'document_url' => 'document_url_here', // TODO
                'is_exported' => true,
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '340c2b31-c6c7-449b-93b0-b059057f2e7c',
                'id_campaign' => '07e96b54-4045-4103-8851-5b65204f0bcd',
                'id_payment' => '331aa0d7-7076-40dc-8c43-2c2b9183b167',
                'document_name' => 'document_name_here', // TODO
                'document_url' => 'document_url_here', // TODO
                'is_exported' => true,
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
