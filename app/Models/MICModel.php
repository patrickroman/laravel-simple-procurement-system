<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MICModel extends Model
{
    use HasFactory;

    public $table = 'micppmp';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
