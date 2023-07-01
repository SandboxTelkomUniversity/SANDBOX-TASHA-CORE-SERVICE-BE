<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CampaignBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //WAITING_VERIFICATION
        DB::table('campaign_banners')->insert([
            [
                'id' => 'fcfc2391-4229-4d24-92b2-6642f27a9778',
                'id_banner' => '288536a4-fa8d-41f7-b1c0-5ed9ee838748',
                'id_campaign' => '08015683-6f49-4509-bb5b-28cf1f8bc70a',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        //REJECT
        DB::table('campaign_banners')->insert([
            [
                'id' => 'f8d8ab2e-6a6a-4a53-b636-a707d53bae82',
                'id_banner' => 'eaa70008-ee20-4848-9bb0-564a0f9aa3da',
                'id_campaign' => 'dec51459-6815-4c9a-8e87-2eb3ef62efbf',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        //ACTIVE
        DB::table('campaign_banners')->insert([
            [
                'id' => '8bc05f85-6b73-46be-bb12-e459435cff8f',
                'id_banner' => 'f88fb830-5900-4e7e-90fe-b54d2686aef6',
                'id_campaign' => 'e677c205-4e40-41c7-ba76-17c120360227',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //ACHIEVED
        DB::table('campaign_banners')->insert([
            [
                'id' => 'a98803d9-8ed5-455b-9581-48cba96df655',
                'id_banner' => 'a8d4d036-197b-47d7-a3d6-bfbca992855d',
                'id_campaign' => '2048f7ff-04cb-48c0-b7d4-c4505230f834',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //PROCESSED
        DB::table('campaign_banners')->insert([
            [
                'id' => '8fef6870-8190-4b5c-9ff2-606c4af2d789',
                'id_banner' => 'b3c4e7c1-820b-4a61-b5b1-3e41f59bfa92',
                'id_campaign' => '153afbca-f0db-48fc-81b7-110acf0c9cbc',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //RUNNING
        DB::table('campaign_banners')->insert([
            [
                'id' => 'e87bce2f-591c-498e-9b8f-fae80022a725',
                'id_banner' => 'e1181f12-3d72-4a1d-977e-6c7517368b1f',
                'id_campaign' => '4aa0b5a1-73c4-402f-98e7-a3ce57668ebb',
                'created_by' => 'system',
                'updated_by' => 'system',
                'is_deleted' => false,
                'version' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //DONE
        DB::table('campaign_banners')->insert([
            [
                'id' => '650408f1-53e9-4daa-9cbc-91572cd3d14f',
                'id_banner' => '3d9c7815-1799-43f7-8dd6-13fe6c345afe',
                'id_campaign' => '07e96b54-4045-4103-8851-5b65204f0bcd',
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
