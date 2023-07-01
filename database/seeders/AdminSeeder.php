<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        DB::table('users')->insert([
            'id' => "d7811e8e-c9d1-4bc4-98e6-2163808e3447",
            'id_user_active' => "a79177c6-42f3-4250-9e02-821f6a4ab11a",
            'id_user_bank' => null,
            'id_user_business' => null,
            'id_user_heir' => null,
            'id_user_image' => null,
            'full_name' => 'Admin',
            'date_of_birth' => '1990-01-01',
            'gender' => 'M',
            'address' => 'Address B',
            'id_card' => '1234567890123457',
            'tax_registration_number' => '123456789012346',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'employment_status' => 'Tasha Employee',
            'authorization_level' => '3',
            'phone_number' => '1234567891',
            'marital_status' => 'Single',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => 1,
        ]);

        DB::table('users')->insert([
            'id' => "59c5e830-dfbb-4e5e-92cf-8dd3df2d5c96",
            'id_user_active' => "ae899c3c-4687-4d85-9b55-a6cb32684554",
            'id_user_bank' => null,
            'id_user_business' => null,
            'id_user_heir' => null,
            'id_user_image' => null,
            'full_name' => 'Admin 1',
            'date_of_birth' => '1990-01-01',
            'gender' => 'M',
            'address' => 'Address B',
            'id_card' => '1234567890123457',
            'tax_registration_number' => '123456789012346',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('password'),
            'employment_status' => 'Tasha Employee',
            'authorization_level' => '3',
            'phone_number' => '1234567891',
            'marital_status' => 'Single',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => 1,
        ]);
    }
}
