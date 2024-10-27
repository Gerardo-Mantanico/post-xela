<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventView extends Model
{
    use HasFactory;
    protected $table = 'events_view';


    protected $fillable = [
        'id_user',
        'title',
        'date_event',
        'time_event',
        'capacity',
        'confirmed',
        'address',
        'description',
        'state_publication',
        'created_at',
        'category',
    ];
}
