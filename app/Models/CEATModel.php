<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CEATModel extends Model
{
    use HasFactory;

    public $table = 'ceatppmp';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;
}
