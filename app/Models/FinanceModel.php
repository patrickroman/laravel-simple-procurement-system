<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceModel extends Model
{
    use HasFactory;

    public $table = 'finance';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
