<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primarykey = 'id_post';

    protected $fillable = [
        'id_user',
        'title',
        'date_event',
        'time_event',
        'capacity',
        'confirmed',
        'description',
        'id_category',
    ];

    protected $attributes = [
        'id_user' => 1,
        'confirmed' => 0,
    ];
}
