<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CEDModel extends Model
{
    use HasFactory;

    public $table = 'cedppmp';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
