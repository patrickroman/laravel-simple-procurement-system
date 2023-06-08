<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MIC_Order_List_Model extends Model
{
    use HasFactory;

    public $table = 'mic_order_list';
    /* public $foreignKey = 'mic_preriv_id'; */
    public $incrementing = true;
    public $timestamps = true;
}
