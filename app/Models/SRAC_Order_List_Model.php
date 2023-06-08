<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRAC_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'srac_order_list';
    /* public $foreignKey = 'srac_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
