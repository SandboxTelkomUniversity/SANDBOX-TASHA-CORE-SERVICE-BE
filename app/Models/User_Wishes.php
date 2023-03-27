<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Wishes extends Model
{
    use HasFactory;
    protected $table = 'user_wishes';
    protected $fillable = [
        'id_user_wishes',
        'id_wish'
    ];

}
