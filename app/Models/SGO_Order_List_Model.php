<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SGO_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'sgo_order_list';
    /* public $foreignKey = 'sgo_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
