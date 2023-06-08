<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CAS_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'cas_order_list';
    /* public $foreignKey = 'cas_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
