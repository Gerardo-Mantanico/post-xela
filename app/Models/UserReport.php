<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    use HasFactory;
    protected $table = 'user_report_post_view';


    protected $fillable = [
        'id_user',
        'cause',
        'name',
    ];
}
