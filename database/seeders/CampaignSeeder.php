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
            'description' => 'Toko Rosaki Putra adalah tujuan utama untuk para fashionista yang mencari pakaian berkualitas tinggi dan bergaya di Dusun Cangak, Kediri. Dengan koleksi yang mewah dan terkini, kami berkomitmen untuk memberikan pengalaman berbelanja yang luar biasa kepada pelanggan kami. Kami menyediakan berbagai macam pilihan baju, mulai dari busana sehari-hari yang trendy hingga gaun pesta yang elegan. Setiap produk yang kami tawarkan dipilih dengan teliti untuk memastikan kualitasnya yang luar biasa dan desain yang menarik. Kami bekerja sama dengan merek-merek terkenal dan desainer terampil untuk membawa tren terbaru dan gaya terkini ke dalam toko kami.',
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
            'description' => 'Laundry Ibu Sri adalah tempat yang tepat untuk mempercayakan kebutuhan laundry Anda. Dengan layanan terwangi yang kami tawarkan, kami berkomitmen untuk memberikan pengalaman laundry terbaik bagi pelanggan kami. Kami memahami betapa pentingnya kebersihan dan kenyamanan pakaian Anda. Oleh karena itu, kami menggunakan peralatan canggih dan produk pembersih berkualitas tinggi untuk memastikan pakaian Anda dicuci dan disetrika dengan sempurna. Tim kami terdiri dari para ahli laundry yang berpengalaman, yang akan menangani pakaian Anda dengan hati-hati dan memastikan hasil yang optimal.',
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
            'name' => 'Fotokopi Pak Rojak',
            'description' => 'Fotokopi Pak Rojak berada pada kawasan Cengkareng. Dikenal dengan layanan fotokopi berkualitas tinggi dan pelayanan yang ramah, Fotokopi Pak Rojak telah menjadi destinasi favorit bagi pelanggan setia dan pengunjung baru. Dengan lebih dari 10 tahun pengalaman dalam industri ini, Fotokopi Pak Rojak telah membuktikan dirinya sebagai salah satu yang terbaik dalam bidangnya. Kami menyediakan berbagai jenis layanan fotokopi, mulai dari fotokopi dokumen berwarna dan hitam-putih hingga fotokopi ukuran besar. Dengan menggunakan peralatan modern dan teknologi canggih, kami dapat menjamin hasil cetak yang jelas, tajam, dan akurat dalam waktu yang singkat. Tidak hanya itu, Fotokopi Pak Rojak juga menyediakan berbagai layanan tambahan seperti laminasi, penggandaan kunci, dan penjilidan. Kami memahami bahwa kebutuhan pelanggan tidak terbatas pada fotokopi semata, oleh karena itu kami berusaha untuk memenuhi segala kebutuhan cetak dan duplikasi yang mungkin Anda miliki.',
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
            'description' => 'Bantu Rezki Beli Nintendo adalah tempat yang dapat membantu mewujudkan kebahagiaan dengan memiliki konsol permainan Nintendo. Kami mengerti betapa pentingnya hiburan dan kesenangan dalam kehidupan sehari-hari, dan kami siap membantu Rezki dalam membeli Nintendo untuk merasa senang dan gembira. Kami menawarkan berbagai pilihan konsol Nintendo terbaru dan perangkat tambahan yang dapat meningkatkan pengalaman bermain game. Dari Nintendo Switch hingga Nintendo Switch Lite, kami memiliki produk-produk berkualitas tinggi yang dapat memenuhi kebutuhan dan preferensi Rezki.',
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
            'description' => 'Toko Kain Bapak Nurdin adalah tujuan terbaik bagi pecinta kain yang mencari pengalaman belanja yang memuaskan dan berkualitas tinggi. Terletak di lokasi yang strategis, toko kami menawarkan koleksi kain yang luas dan beragam untuk memenuhi berbagai kebutuhan fashion dan kerajinan tangan. Kami bangga menyediakan kain-kain berkualitas terbaik dari berbagai jenis, termasuk sutra, katun, wol, linen, rayon, dan banyak lagi. Setiap jenis kain dipilih dengan cermat untuk memastikan kualitas dan tampilan yang memukau. Dalam koleksi kami, Anda akan menemukan berbagai corak, warna, dan tekstur yang menginspirasi kreativitas Anda.',
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
            'description' => 'Depot Soto Bapak Nurdin adalah tempat yang sempurna bagi pecinta kuliner yang mencari cita rasa otentik dan nikmat. Kami adalah destinasi kuliner yang terletak di lokasi yang strategis, dan kami bangga menyajikan hidangan soto yang lezat dan memikat selera. Kami menggunakan resep warisan keluarga yang telah terjaga selama bertahun-tahun, sehingga setiap mangkuk soto yang kami sajikan memiliki rasa yang autentik dan kaya akan rempah-rempah. Dengan bahan-bahan segar dan pilihan daging berkualitas tinggi, kami menjaga kualitas makanan kami untuk memberikan pengalaman kuliner yang memuaskan bagi pelanggan setia dan pengunjung baru.',
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
            'description' => 'Pom Bensin Bapak Nurdin adalah tempat yang dapat Anda andalkan untuk memenuhi kebutuhan bahan bakar kendaraan Anda dengan keandalan dan kenyamanan yang pasti pas. Kami memahami pentingnya ketersediaan bahan bakar yang handal dan layanan yang cepat untuk para pengendara. Oleh karena itu, kami menyediakan berbagai jenis bahan bakar berkualitas tinggi, termasuk bensin dan solar, yang dijamin untuk memastikan kinerja optimal kendaraan Anda.',
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
            'name' => 'Batik Tulis Naynay',
            'description' => 'Batik Tulis Naynay adalah destinasi terbaik bagi pecinta batik yang mencari karya batik berkualitas tinggi. Kami bangga menyajikan batik tulis yang indah dan autentik, menggabungkan keindahan tradisional dengan sentuhan modern. Kami bekerja sama dengan pengrajin batik yang berbakat dan berpengalaman untuk menciptakan karya-karya batik yang unik dan menakjubkan. Setiap potongan batik dihasilkan dengan tangan yang penuh dedikasi dan keahlian, menjadikan setiap kain batik sebagai karya seni yang istimewa.',
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
