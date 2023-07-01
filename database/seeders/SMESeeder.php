<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SMESeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        
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

        DB::table('user_images')->insert([
            'id' => "1fb94347-49bf-4de5-b68f-bec659439162",
            'id_card_url' => 'https://bimamedia-gurusiana.ap-south-1.linodeobjects.com/099fe6b0b444c23836c4a5d07346082b/2021/04/20/l-img20210420015823jpg20210420005933.jpeg',
            'id_card_with_face_url' => 'https://video-images.vice.com/articles/58d4d6c1d2cd8d1f1e3474e8/lede/1490348630322-KTP-edit.jpeg',
            'selfie_url' => 'https://img.freepik.com/free-photo/close-up-smiley-man-taking-selfie_23-2149155156.jpg?w=2000',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);

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

        DB::table('user_business')->insert([
            'id' => "cebb1ce5-d891-4a85-9bde-d29cc2ba6e38",
            'name' => 'Burgundi',
            'certificate_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'address' => 'Alamat Bisnis',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => 1,
        ]);

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

        DB::table('user_images')->insert([
            'id' => "dff91d20-6736-4e0e-97df-fd78b98f5a59",
            'id_card_url' => 'https://bimamedia-gurusiana.ap-south-1.linodeobjects.com/099fe6b0b444c23836c4a5d07346082b/2021/04/20/l-img20210420015823jpg20210420005933.jpeg',
            'id_card_with_face_url' => 'https://video-images.vice.com/articles/58d4d6c1d2cd8d1f1e3474e8/lede/1490348630322-KTP-edit.jpeg',
            'selfie_url' => 'https://img.freepik.com/free-photo/close-up-smiley-man-taking-selfie_23-2149155156.jpg?w=2000',
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

        DB::table('user_business')->insert([
            'id' => "a7d4a545-38a1-4e89-b753-d11cca53c5af",
            'name' => 'Sumpil',
            'certificate_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'address' => 'Alamat Bisnis',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => 1,
        ]);

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
