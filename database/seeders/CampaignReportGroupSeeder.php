<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

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
                'id_campaign_report_detail' => '979789c4-bcd5-4feb-9633-f5355ea5b112',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '6ce9a47d-64fc-4434-a6c4-aed4a922ca7c',
                'id_campaign_report' => 'bafc7c42-27a9-485e-9527-005951aae1ef',
                'id_campaign_report_detail' => '747ded3a-a075-4af1-aa33-04f4693f7b23',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '8657b1f0-456c-429f-8084-5c4ce0f9775f',
                'id_campaign_report' => 'bafc7c42-27a9-485e-9527-005951aae1ef',
                'id_campaign_report_detail' => 'd7880e3b-f6af-4490-94da-5286f4c291df',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'fbc8d68e-3686-44ca-b5f0-a07449ae72c1',
                'id_campaign_report' => 'bafc7c42-27a9-485e-9527-005951aae1ef',
                'id_campaign_report_detail' => 'fbb7b0b8-e0c0-44b0-9be9-8681bd59b858',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '37a5645c-c550-4eb7-8e8f-507321bb66b2',
                'id_campaign_report' => 'bafc7c42-27a9-485e-9527-005951aae1ef',
                'id_campaign_report_detail' => '90a773d5-10d0-41f0-a203-1252eddfa032',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '40986b2e-262f-4ef7-80d8-2af33e5afa67',
                'id_campaign_report' => 'bafc7c42-27a9-485e-9527-005951aae1ef',
                'id_campaign_report_detail' => '316e9617-e20f-45f7-a76d-f98c0d2fc1da',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);

        // Campaign Done Part 1
        DB::table('campaign_report_groups')->insert([
            [
                'id' => 'fd0f9b36-e858-457f-b8e1-4652b6fe1727',
                'id_campaign_report' => 'cbd8db3d-3cd4-4730-aee9-3f0c4cd13e47',
                'id_campaign_report_detail' => '7e6d3efd-df6b-4504-96e8-e157d3b70bf0',
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
                'id_campaign_report_detail' => '8885ab25-27ee-402e-bf01-753123dbc47a',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '93435b40-2e83-4d37-beef-a67c38f93641',
                'id_campaign_report' => 'cbd8db3d-3cd4-4730-aee9-3f0c4cd13e47',
                'id_campaign_report_detail' => '6a16aaf5-f24a-43da-bf21-0c6235d7bc89',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'fecd5852-d674-4ca6-9c55-f5ca6290d597',
                'id_campaign_report' => 'cbd8db3d-3cd4-4730-aee9-3f0c4cd13e47',
                'id_campaign_report_detail' => 'd84e9ee8-fff9-42ce-abad-e4b64454ee65',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'ce97526c-ddfc-44b6-8f85-f8f232adee89',
                'id_campaign_report' => 'cbd8db3d-3cd4-4730-aee9-3f0c4cd13e47',
                'id_campaign_report_detail' => '359c8d4f-84a0-4525-83cd-a7bef6900fc6',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '857b7ed0-0903-4f1a-b79f-e6a3d0b66c6b',
                'id_campaign_report' => 'cbd8db3d-3cd4-4730-aee9-3f0c4cd13e47',
                'id_campaign_report_detail' => '2a6bba81-bdf8-4195-850e-6111c0a2fa64',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Campaign Done Part 2
        DB::table('campaign_report_groups')->insert([
            [
                'id' => 'f4970d3f-b7bc-4f39-87e1-094685fc3228',
                'id_campaign_report' => '340c2b31-c6c7-449b-93b0-b059057f2e7c',
                'id_campaign_report_detail' => '120a41f9-4ee2-48c2-a1b7-a071aaf01ce9',
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
                'id_campaign_report_detail' => 'be4a79ed-259a-4c4c-87f4-b1e012bb050f',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3454b84d-8830-43da-8406-b7aed2ab698b',
                'id_campaign_report' => '340c2b31-c6c7-449b-93b0-b059057f2e7c',
                'id_campaign_report_detail' => 'c3b702a4-672e-4cba-ba32-93b37b815c0a',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '0ba0c3cb-4bfe-4cf5-a21b-ff6f42ca7c11',
                'id_campaign_report' => '340c2b31-c6c7-449b-93b0-b059057f2e7c',
                'id_campaign_report_detail' => 'c083b298-1127-4209-84f5-b7d3cb00d63a',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'c3f41beb-ac62-488f-a70c-eccca191f53e',
                'id_campaign_report' => '340c2b31-c6c7-449b-93b0-b059057f2e7c',
                'id_campaign_report_detail' => '86fff8fd-c588-470d-96c9-1840c46c5976',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '33f41555-bbf7-4de6-8b14-81d9e6aa584e',
                'id_campaign_report' => '340c2b31-c6c7-449b-93b0-b059057f2e7c',
                'id_campaign_report_detail' => '8189ed07-b1bb-4221-8e29-32dedd276ea9',
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
