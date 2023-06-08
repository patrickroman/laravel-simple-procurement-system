<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CEAT_OrderList_Data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ceat_order_list')->insert([
            ['ceat_preriv_id'=>3,'quantity'=>2,'item_id'=>1,'unit'=>'Bottle','unit_price'=>43.79],
            ['ceat_preriv_id'=>3,'quantity'=>2,'item_id'=>2,'unit'=>'Bottle','unit_price'=>30.8],
            ['ceat_preriv_id'=>4,'quantity'=>2,'item_id'=>1,'unit'=>'Bottle','unit_price'=>43.79]
        ]);
    }
}
