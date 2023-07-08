<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => "a08a311b-1753-4d07-a01e-11c84986e38c",
            'id_user_active' => "ec59ae11-06b1-47aa-80ca-51433ea9dfda",
            'id_user_bank' => "9a630623-6c38-4748-9436-56b361be6afc",
            'id_user_business' => null,
            'id_user_heir' => "aa1f2bbc-85f9-41ef-94ed-bae849beb5e3",
            'id_user_image' => "d454b3e1-4f79-4e4d-86f6-743435da83a5",
            'full_name' => 'Pulu Pulu',
            'date_of_birth' => '1990-01-01',
            'gender' => 'M',
            'address' => 'Address A',
            'id_card' => '1234567890123456',
            'tax_registration_number' => '123456789012345',
            'email' => 'investor@gmail.com',
            'password' => bcrypt('password'),
            'employment_status' => 'Employed',
            'authorization_level' => '1',
            'phone_number' => '1234567890',
            'marital_status' => 'Single',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => 1,
        ]);
#
        DB::table('users')->insert([
            'id' => "0b5ce901-822e-4965-b88d-1b868450e306",
            'id_user_active' => "aed9b1f5-c492-45a0-a38e-1bd7a2e6dcd0",
            'id_user_bank' => "f4870434-18e8-4d36-899b-9e80020a2f06",
            'id_user_business' => null,
            'id_user_heir' => "b3de3ef3-59f5-4912-adc6-12a47c06e0c2",
            'id_user_image' => "05719190-d55c-40ef-92dc-be31e32aaa08",
            'full_name' => 'Tiara Android',
            'date_of_birth' => '1990-01-01',
            'gender' => 'M',
            'address' => 'Address B',
            'id_card' => '1234567890123457',
            'tax_registration_number' => '123456789012346',
            'email' => 'investor@gmail.com',
            'password' => bcrypt('password'),
            'employment_status' => 'Employed',
            'authorization_level' => '1',
            'phone_number' => '1234567891',
            'marital_status' => 'Single',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => 1,
        ]);
    }
}
