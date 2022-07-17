<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    const TG = 'tg';
    const PS = 'ps';

    const TIPO = [
        self::TG,
        self::PS,
    ];

    protected $fillable = [
        'nombre',
        'tipo',
        'documento'
    ];
}
