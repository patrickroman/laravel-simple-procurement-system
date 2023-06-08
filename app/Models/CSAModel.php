<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSAModel extends Model
{
    use HasFactory;

    public $table = 'csappmp';
    public $primaryKey = 'ppmpID';
    public $incrementing = true;
    public $timestamps = true;

    /* protected $fillable = [
        'ItemCode',
        'ItemDet',
        'UnitMeas',
        'Jan',
        'Feb',
        'Mar',
        'Q1',
        'Q1Amount',
        'Apr',
        'May',
        'June',
        'Q2',
        'Q2Amount',
        'July',
        'Aug',
        'Sept',
        'Q3',
        'Q3Amount',
        'Oct',
        'Nov',
        'Dec',
        'Q4',
        'Q4Amount',
        'TotalQ',
        'Price',
        'TotalAmount',
        'created_at',
        'updated_at'
    ]; */
}
