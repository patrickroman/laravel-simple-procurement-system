<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrailModel extends Model
{
    use HasFactory;

    public $table = 'logs';
    public $primaryKey = 'log_id';
    public $incrementing = true;
    public $timestamps = true;
}
