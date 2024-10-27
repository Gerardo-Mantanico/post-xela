<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'id_user',
        'title',
        'date_event',
        'time_event',
        'capacity',
        'confirmed',
        'address',
        'description',
        'id_category',
        'state_publication',
    ];

    protected $attributes = [
        'confirmed' => 0,
        'state_publication' => 'PENDING',
    ];
}
