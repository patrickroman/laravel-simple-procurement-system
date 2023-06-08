<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRACModel extends Model
{
    use HasFactory;

    public $table = 'sracppmp';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
