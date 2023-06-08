<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BACModel extends Model
{
    use HasFactory;

    public $table = 'bac';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
