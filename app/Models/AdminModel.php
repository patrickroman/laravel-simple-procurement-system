<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Model
{
    use HasFactory;
    use Notifiable;
    public $table = 'users';
    public $primaryKey = 'userID';
    public $incrementing = true;
    public $timestamps = true;
}
