<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class Admin_User_Data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['Firstname'=>'Administrator','Lastname'=>'Admin','Email'=>'admin001@gmail.com','Password'=>'admin123','Department'=>'Supply Office','Role'=>'Admin','code'=>'SXHFKYB5VZ'],
            ['Firstname'=>'Administrator','Lastname'=>'Admin','Email'=>'admin002@gmail.com','Password'=>'admin123','Department'=>'BAC Office','Role'=>'Admin','code'=>''],
            ['Firstname'=>'Administrator','Lastname'=>'Admin','Email'=>'admin003@gmail.com','Password'=>'admin123','Department'=>'BAC Office','Role'=>'Admin','code'=>''],
            ['Firstname'=>'John','Lastname'=>'Wick','Email'=>'supplyoffice@gmail.com','Password'=>'user123','Department'=>'Supply Office','Role'=>'Approver','code'=>''],
            ['Firstname'=>'Drake','Lastname'=>'Villafranca','Email'=>'financedirector@gmail.com','Password'=>'user123','Department'=>'Finance Office','Role'=>'Approver','code'=>''],
            ['Firstname'=>'John','Lastname'=>'Cena','Email'=>'officepres@gmail.com','Password'=>'user123','Department'=>'Office of the President','Role'=>'Approver','code'=>''],
            ['Firstname'=>'Alessandrio','Lastname'=>'Vega','Email'=>'bacoffice@gmail.com','Password'=>'user123','Department'=>'BAC Office','Role'=>'Approver','code'=>''],
            ['Firstname'=>'Jay-Jay','Lastname'=>'Melegrito','Email'=>'ceatdirector@gmail.com','Password'=>'user123','Department'=>'CEAT','Role'=>'Requestor','code'=>''],
            ['Firstname'=>'Patrick','Lastname'=>'Roman','Email'=>'patrickroman130@gmail.com','Password'=>'user123','Department'=>'CSA','Role'=>'Requestor','code'=>''],
            ['Firstname'=>'Reymart','Lastname'=>'Vigo','Email'=>'locabareymart11@gmail.com','Password'=>'user123','Department'=>'MIC','Role'=>'Admin','code'=>'QGUYK9APXT']
        ]);
    }
}
