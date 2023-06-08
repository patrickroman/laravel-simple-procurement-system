<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CSA_OrderList_Data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('csa_order_list')->insert([
            ['csa_preriv_id'=>1,'quantity'=>2,'item_id'=>1,'unit'=>'Bottle','unit_price'=>43.79],
            ['csa_preriv_id'=>1,'quantity'=>2,'item_id'=>2,'unit'=>'Bottle','unit_price'=>30.8],
            ['csa_preriv_id'=>2,'quantity'=>2,'item_id'=>1,'unit'=>'Bottle','unit_price'=>43.79]
        ]);
    }
}
