<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHeirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role Investor
        DB::table('user_heirs')->insert([
            'id' => "aa1f2bbc-85f9-41ef-94ed-bae849beb5e3",
            'name' => 'Heir A',
            'relationship' => 'Child',
            'phone_number' => '1234567890',
            'address' => 'Address A',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);

        DB::table('user_heirs')->insert([
            'id' => "b3de3ef3-59f5-4912-adc6-12a47c06e0c2",
            'name' => 'Heir B',
            'relationship' => 'Parent',
            'phone_number' => '1234567899',
            'address' => 'Address B',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);
    }
}
