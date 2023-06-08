<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSA_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'csa_order_list';
    /* public $foreignKey = 'csa_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
