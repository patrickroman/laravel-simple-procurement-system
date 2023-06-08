<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficePresModel extends Model
{
    use HasFactory;

    public $table = 'president';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
