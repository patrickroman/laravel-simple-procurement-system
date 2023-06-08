<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CED_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'ced_order_list';
    /* public $foreignKey = 'ced_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
