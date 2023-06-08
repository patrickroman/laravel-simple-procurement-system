<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class Request_Data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('request')->insert([
            ['created_at'=>'2022-10-17 14:41:59','requested_by'=>9,'department'=>'CSA','control_no'=>'2022-10-001','item_count'=>2,'total_price'=>149.18,'delivered_to'=>'Supply Office','request_status'=>0,'notes'=>'N/A','purpose'=>'N/A','budget_source'=>'N/A','action_taken'=>'N/A','remarks'=>''],
            ['created_at'=>'2022-10-17 14:41:59','requested_by'=>9,'department'=>'CSA','control_no'=>'2022-10-002','item_count'=>1,'total_price'=>87.58,'delivered_to'=>'Supply Office','request_status'=>0,'notes'=>'N/A','purpose'=>'N/A','budget_source'=>'N/A','action_taken'=>'N/A','remarks'=>''],
            ['created_at'=>'2022-10-17 14:41:59','requested_by'=>8,'department'=>'CEAT','control_no'=>'2022-10-003','item_count'=>2,'total_price'=>149.18,'delivered_to'=>'Supply Office','request_status'=>0,'notes'=>'N/A','purpose'=>'N/A','budget_source'=>'N/A','action_taken'=>'N/A','remarks'=>''],
            ['created_at'=>'2022-10-17 14:41:59','requested_by'=>8,'department'=>'CEAT','control_no'=>'2022-10-004','item_count'=>1,'total_price'=>87.58,'delivered_to'=>'Supply Office','request_status'=>0,'notes'=>'N/A','purpose'=>'N/A','budget_source'=>'N/A','action_taken'=>'N/A','remarks'=>'']
        ]);
    }
}
