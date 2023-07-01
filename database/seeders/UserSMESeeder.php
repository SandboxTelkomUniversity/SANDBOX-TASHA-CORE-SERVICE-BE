<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSMESeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => "37ef9363-16e8-44ee-b5f4-928d5f974f1f",
            'id_user_active' => "41681659-4728-4ff5-b1c6-ac6762dc4f8c",
            'id_user_bank' => "efce4d0a-a063-4b86-8100-da44d60f7f90",
            'id_user_business' => "cebb1ce5-d891-4a85-9bde-d29cc2ba6e38",
            'id_user_heir' => null,
            'id_user_image' => "1fb94347-49bf-4de5-b68f-bec659439162",
            'full_name' => 'Owner Burgundi',
            'date_of_birth' => '1990-01-01',
            'gender' => 'M',
            'address' => 'Address A',
            'id_card' => '1234567890123456',
            'tax_registration_number' => '123456789012345',
            'email' => 'sme@gmail.com',
            'password' => bcrypt('password'),
            'employment_status' => 'Employed',
            'authorization_level' => '2',
            'phone_number' => '1234567890',
            'marital_status' => 'Single',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => 1,
        ]);

        //User 2
        DB::table('users')->insert([
            'id' => "c2169bb5-43d3-4abd-af69-ffbb1303b1de",
            'id_user_active' => "2bef6768-4f1f-4c95-b290-b69db9e497f5",
            'id_user_bank' => "737ec63f-5dca-4726-bf96-ff05d8d7017b",
            'id_user_business' => "a7d4a545-38a1-4e89-b753-d11cca53c5af",
            'id_user_heir' => null,
            'id_user_image' => "dff91d20-6736-4e0e-97df-fd78b98f5a59",
            'full_name' => 'Owner Sumpil',
            'date_of_birth' => '1990-01-01',
            'gender' => 'M',
            'address' => 'Address A',
            'id_card' => '1234567890123456',
            'tax_registration_number' => '123456789012345',
            'email' => 'sme2@gmail.com',
            'password' => bcrypt('password'),
            'employment_status' => 'Employed',
            'authorization_level' => '2',
            'phone_number' => '1234567890',
            'marital_status' => 'Single',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => 1,
        ]);

    }
}
