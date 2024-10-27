<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories'; // Asegúrate de que apunte a la tabla correcta


    // Especifica los campos que se pueden llenar
    protected $fillable = [
        'category', // Debe coincidir con el nombre del campo en la base de datos
    ];
}
