<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OVP_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'ovp_order_list';
    /* public $foreignKey = 'ovp_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
