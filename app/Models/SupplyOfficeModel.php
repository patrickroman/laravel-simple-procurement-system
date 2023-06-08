<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyOfficeModel extends Model
{
    use HasFactory;

    public $table = 'supply';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
