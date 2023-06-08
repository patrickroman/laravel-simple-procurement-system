<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'supply_order_list';
    public $incrementing = true;
    public $timestamps = true;
}
