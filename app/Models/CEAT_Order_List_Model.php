<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CEAT_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'ceat_order_list';
    /* public $foreignKey = 'ceat_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
