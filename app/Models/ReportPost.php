<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPost extends Model
{
    use HasFactory;
    protected $table = 'report_post';
    protected $primaryKey = 'id_report';
    protected $fillable = [
        'id_post',
        'id_user_report',
        'id_admin',
        'cause',
        'state_report'
    ];

    protected $attributes = [
        'id_admin' => null,
        'state_report' => 'PENDING',
    ];
}
