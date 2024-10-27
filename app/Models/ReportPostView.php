<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPostView extends Model
{
    use HasFactory;
    protected $table = 'report_post_view';


    protected $fillable = [
        'id_post',
        'id_admin',
        'state_report',
        'creted_at',
        'no_report',
        'id_user',
        'name',
        'title',
        'date_event',
        'time_event',
        'capacity',
        'confirmed',
        'address',
        'description',
        'state_publication',
        'created post',
        'category' 
    ];
}
