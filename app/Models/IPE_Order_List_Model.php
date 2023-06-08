<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPE_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'ipe_order_list';
    /* public $foreignKey = 'ipe_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
