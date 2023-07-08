<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
