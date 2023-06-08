<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRDC_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'hrdc_order_list';
    /* public $foreignKey = 'hrdc_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
