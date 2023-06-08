<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CBET_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'cbet_order_list';
    /* public $foreignKey = 'cbet_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
