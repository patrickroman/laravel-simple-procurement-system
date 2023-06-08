<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SGOModel extends Model
{
    use HasFactory;

    public $table = 'sgoppmp';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
