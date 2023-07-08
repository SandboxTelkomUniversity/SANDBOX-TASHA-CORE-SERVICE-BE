<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role Investor
        DB::table('user_images')->insert([
            'id' => "d454b3e1-4f79-4e4d-86f6-743435da83a5",
            'id_card_url' => 'https://bimamedia-gurusiana.ap-south-1.linodeobjects.com/099fe6b0b444c23836c4a5d07346082b/2021/04/20/l-img20210420015823jpg20210420005933.jpeg',
            'id_card_with_face_url' => 'https://video-images.vice.com/articles/58d4d6c1d2cd8d1f1e3474e8/lede/1490348630322-KTP-edit.jpeg',
            'selfie_url' => 'https://img.freepik.com/free-photo/close-up-smiley-man-taking-selfie_23-2149155156.jpg?w=2000',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);

        DB::table('user_images')->insert([
            'id' => "05719190-d55c-40ef-92dc-be31e32aaa08",
            'id_card_url' => 'https://bimamedia-gurusiana.ap-south-1.linodeobjects.com/099fe6b0b444c23836c4a5d07346082b/2021/04/20/l-img20210420015823jpg20210420005933.jpeg',
            'id_card_with_face_url' => 'https://video-images.vice.com/articles/58d4d6c1d2cd8d1f1e3474e8/lede/1490348630322-KTP-edit.jpeg',
            'selfie_url' => 'https://img.freepik.com/free-photo/close-up-smiley-man-taking-selfie_23-2149155156.jpg?w=2000',
            'updated_by' => 'system',
            'created_by' => 'system',
            'is_deleted' => "0",
            'version' => "1",
        ]);
        // Role SME
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
    }
}
