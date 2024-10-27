<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterEvent extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'events'; // Asegúrate de que apunte a la tabla correcta


    // Especifica los campos que se pueden llenar
    protected $fillable = [
        'id_post',
        'id_user',
    ];
}
