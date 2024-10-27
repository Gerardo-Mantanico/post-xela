<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    use HasFactory;
    protected $table = 'post_view';


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
        'created_at',
        'name',
        'category',
    ];
}
