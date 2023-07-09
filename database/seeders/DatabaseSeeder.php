<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CampaignReport;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeders = [
            new UserActiveSeeder(),
            new UserImageSeeder(),
            new UserBankSeeder(),
            new UserHeirSeeder(),
            new UserBusinessSeeder(),
            new UserInvestorSeeder(),
            new UserSMESeeder(),
            new UserAdminSeeder(),
            new BannerSeeder(),
            new CampaignSeeder(),
            new CampaignBannerSeeder(),
            new ReceiptSeeder(),
            new PaymentSeeder(),
            new TransactionSeeder(),
            new WithdrawSeeder(),
            new CampaignReportDetailSeeder(),
            new CampaignReportSeeder(),
            new CampaignReportGroupSeeder(),
        ];

        foreach ($seeders as $seeder) {
            $seeder->run();
        }

    }
}
