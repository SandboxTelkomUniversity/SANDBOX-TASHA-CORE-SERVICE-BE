<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserActiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role Investor
        DB::table('user_actives')->insert([
            "id" => "ec59ae11-06b1-47aa-80ca-51433ea9dfda",
            "phone_number" => "1",
            "email" => "1",
            "id_card" => "1",
            "tax_registration_number" => "1",
            "user_bank" => "1",
            "user_business" => "0",
            "updated_by" => "system",
            "created_by" => "system",
            "is_deleted" => "0",
            "version" => "1",
        ]);

        DB::table('user_actives')->insert([
            "id" => "aed9b1f5-c492-45a0-a38e-1bd7a2e6dcd0",
            "phone_number" => "1",
            "email" => "1",
            "id_card" => "1",
            "tax_registration_number" => "1",
            "user_bank" => "1",
            "user_business" => "0",
            "updated_by" => "system",
            "created_by" => "system",
            "is_deleted" => "0",
            "version" => "1",
        ]);
        // Role SME
        DB::table('user_actives')->insert([
            "id" => "41681659-4728-4ff5-b1c6-ac6762dc4f8c",
            "phone_number" => "1",
            "email" => "1",
            "id_card" => "1",
            "tax_registration_number" => "1",
            "user_bank" => "1",
            "user_business" => "0",
            "updated_by" => "system",
            "created_by" => "system",
            "is_deleted" => "0",
            "version" => "1",
        ]);
        
        DB::table('user_actives')->insert([
            "id" => "2bef6768-4f1f-4c95-b290-b69db9e497f5",
            "phone_number" => "1",
            "email" => "1",
            "id_card" => "1",
            "tax_registration_number" => "1",
            "user_bank" => "1",
            "user_business" => "0",
            "updated_by" => "system",
            "created_by" => "system",
            "is_deleted" => "0",
            "version" => "1",
        ]);
        // Role Admin
        DB::table('user_actives')->insert([
            "id" => "a79177c6-42f3-4250-9e02-821f6a4ab11a",
            "phone_number" => "1",
            "email" => "1",
            "id_card" => "1",
            "tax_registration_number" => "1",
            "user_bank" => "1",
            "user_business" => "0",
            "updated_by" => "system",
            "created_by" => "system",
            "is_deleted" => "0",
            "version" => "1",
        ]);

        DB::table('user_actives')->insert([
            "id" => "ae899c3c-4687-4d85-9b55-a6cb32684554",
            "phone_number" => "1",
            "email" => "1",
            "id_card" => "1",
            "tax_registration_number" => "1",
            "user_bank" => "1",
            "user_business" => "0",
            "updated_by" => "system",
            "created_by" => "system",
            "is_deleted" => "0",
            "version" => "1",
        ]);
    }
}
