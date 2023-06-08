<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call ([
            Admin_User_Data::class,
            CSA_PPMP_Data::class,
            CEAT_PPMP_Data::class,
            CBET_PPMP_Data::class,
            CAS_PPMP_Data::class,
            CED_PPMP_Data::class,
            IPE_PPMP_Data::class,
            SUPPLY_PPMP_Data::class,
            FINANCE_PPMP_Data::class,
            PRESIDENT_PPMP_Data::class,
            BAC_PPMP_Data::class,
            MIC_PPMP_Data::class,
            DRRMO_PPMP_Data::class,
            GCSC_PPMP_Data::class,
            OVP_PPMP_Data::class,
            SGO_PPMP_Data::class,
            SRAC_PPMP_Data::class,
            HRDC_PPMP_Data::class,
            Request_Data::class,
            CEAT_OrderList_Data::class,
            CSA_OrderList_Data::class
        ]);
    }
}
