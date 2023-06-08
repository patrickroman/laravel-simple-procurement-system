<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class President_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'president_order_list';
    public $incrementing = true;
    public $timestamps = true;
}
