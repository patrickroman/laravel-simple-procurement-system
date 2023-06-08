<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DRRMO_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'drrmo_order_list';
    /* public $foreignKey = 'drrmo_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
