<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role Investor
        DB::table('user_banks')->insert([
            'id' => "9a630623-6c38-4748-9436-56b361be6afc",
            'bank_name' => 'Bank Negara Indonesia',
            'account_number' => '1234567890',
            'account_name' => 'Pulu Pulu',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);

        DB::table('user_banks')->insert([
            'id' => "f4870434-18e8-4d36-899b-9e80020a2f06",
            'bank_name' => 'Bank Central Asia',
            'account_number' => '1234567891',
            'account_name' => 'Tiara Android',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);

        // Role SME
        DB::table('user_banks')->insert([
            'id' => "efce4d0a-a063-4b86-8100-da44d60f7f90",
            'bank_name' => 'Bank Negara Indonesia',
            'account_number' => '1234567890',
            'account_name' => 'Pulu Pulu',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);

        DB::table('user_banks')->insert([
            'id' => "737ec63f-5dca-4726-bf96-ff05d8d7017b",
            'bank_name' => 'Bank Negara Indonesia',
            'account_number' => '1234567891',
            'account_name' => 'Owner Sumpil',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);

    }
}
