<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // WAITING_VERIFICATION
        DB::table('campaigns')->insert([
            'id' => "08015683-6f49-4509-bb5b-28cf1f8bc70a",
            'id_user' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'name' => 'Toko Rosaki Putra',
            'description' => 'Toko Baju Paling Mewah di Dusun Cangak Kediri',
            'type' => 'Musyarakah',
            'target_funding_amount' => 1000000,
            'current_funding_amount' => 0,
            'start_date' => '2023-07-01',
            'closing_date' => '2023-08-01',
            'return_investment_period' => 3,
            'status' => 'WAITING_VERIFICATION',
            'prospektus_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'category' => 'Fashion',
            'is_approved' => "1",
            'max_sukuk' => 100,
            'tenors' => 12,
            'profit_share' => 0.5,
            'sold_sukuk' => 0,
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => 0,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // REJECTED
        DB::table('campaigns')->insert([
            'id' => "dec51459-6815-4c9a-8e87-2eb3ef62efbf",
            'id_user' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'name' => 'Laundry Ibu Sri',
            'description' => 'Laundry terwangi',
            'type' => 'Musyarakah',
            'target_funding_amount' => 1000000,
            'current_funding_amount' => 0,
            'start_date' => '2023-07-01',
            'closing_date' => '2023-08-01',
            'return_investment_period' => 4,
            'status' => 'REJECTED',
            'prospektus_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'category' => 'Fashion',
            'is_approved' => "1",
            'max_sukuk' => 100,
            'tenors' => 12,
            'profit_share' => 0.5,
            'sold_sukuk' => 0,
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => 0,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ACTIVE
        DB::table('campaigns')->insert([
            'id' => "e677c205-4e40-41c7-ba76-17c120360227",
            'id_user' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'name' => 'Ayo Beli Burgundi',
            'description' => 'Burgundi mantep',
            'type' => 'Musyarakah',
            'target_funding_amount' => 1000000,
            'current_funding_amount' => 500000,
            'start_date' => '2023-07-01',
            'closing_date' => '2023-08-01',
            'return_investment_period' => 6,
            'status' => 'ACTIVE',
            'prospektus_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'category' => 'Makanan',
            'is_approved' => "1",
            'max_sukuk' => 100,
            'tenors' => 12,
            'profit_share' => 0.5,
            'sold_sukuk' => 50,
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => 0,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ACHIEVED
        DB::table('campaigns')->insert([
            'id' => "2048f7ff-04cb-48c0-b7d4-c4505230f834",
            'id_user' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'name' => 'Bantu Rezki Beli Nintendo',
            'description' => 'biar seneng',
            'type' => 'Musyarakah',
            'target_funding_amount' => 2000000,
            'current_funding_amount' => 2000000,
            'start_date' => '2023-07-01',
            'closing_date' => '2023-08-10',
            'return_investment_period' => 3,
            'status' => 'ACHIEVED',
            'prospektus_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'category' => 'Technology',
            'is_approved' => "1",
            'max_sukuk' => 100,
            'tenors' => 12,
            'profit_share' => 0.5,
            'sold_sukuk' => 100,
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => 0,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //PROCESSED
        DB::table('campaigns')->insert([
            'id' => "153afbca-f0db-48fc-81b7-110acf0c9cbc",
            'id_user' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'name' => 'Toko Kain Bapak Nurdin',
            'description' => 'ayo beli beliiiiiii',
            'type' => 'Musyarakah',
            'target_funding_amount' => 1000000,
            'current_funding_amount' => 1000000,
            'start_date' => '2023-07-01',
            'closing_date' => '2023-08-20',
            'return_investment_period' => 4,
            'status' => 'PROCESSED',
            'prospektus_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'category' => 'Tekstil',
            'is_approved' => "1",
            'max_sukuk' => 100,
            'tenors' => 12,
            'profit_share' => 0.5,
            'sold_sukuk' => 100,
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => 0,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //RUNNING
        DB::table('campaigns')->insert([
            'id' => "4aa0b5a1-73c4-402f-98e7-a3ce57668ebb",
            'id_user' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'name' => 'Depot Soto Bapak Nurdin',
            'description' => 'beli ygy',
            'type' => 'Musyarakah',
            'target_funding_amount' => 1000000,
            'current_funding_amount' => 1000000,
            'start_date' => '2023-07-01',
            'closing_date' => '2023-08-21',
            'return_investment_period' => 3,
            'status' => 'RUNNING',
            'prospektus_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'category' => 'Makanan',
            'is_approved' => "1",
            'max_sukuk' => 100,
            'tenors' => 6,
            'profit_share' => 0.5,
            'sold_sukuk' => 100,
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => 0,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('campaigns')->insert([
            'id' => "8537ceae-3982-49b6-a360-a33024731dda",
            'id_user' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'name' => 'Pom Bensin Bapak Nurdin',
            'description' => 'pasti pas',
            'type' => 'Musyarakah',
            'target_funding_amount' => 5000000,
            'current_funding_amount' => 5000000,
            'start_date' => '2023-07-01',
            'closing_date' => '2023-08-22',
            'return_investment_period' => 4,
            'status' => 'RUNNING',
            'prospektus_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'category' => 'Makanan',
            'is_approved' => "1",
            'max_sukuk' => 100,
            'tenors' => 12,
            'profit_share' => 0.5,
            'sold_sukuk' => 100,
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => 1,
            'version' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //DONE
        DB::table('campaigns')->insert([
            'id' => "07e96b54-4045-4103-8851-5b65204f0bcd",
            'id_user' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'name' => 'Batik Tulis naynay',
            'description' => 'batik berkualitas',
            'type' => 'Musyarakah',
            'target_funding_amount' => 1000000,
            'current_funding_amount' => 1000000,
            'start_date' => '2023-07-01',
            'closing_date' => '2023-08-21',
            'return_investment_period' => 3,
            'status' => 'DONE',
            'prospektus_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'category' => 'Makanan',
            'is_approved' => "1",
            'max_sukuk' => 100,
            'tenors' => 6,
            'profit_share' => 0.5,
            'sold_sukuk' => 100,
            'created_by' => 'system',
            'updated_by' => 'system',
            'is_deleted' => 0,
            'version' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
