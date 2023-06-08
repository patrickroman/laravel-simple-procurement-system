<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GCSC_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'gcsc_order_list';
    /* public $foreignKey = 'gcsc_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
