<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestModel extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'request';
    public $primaryKey = 'request_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
