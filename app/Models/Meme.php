<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    use HasFactory;

    protected $connection = 'pgsql'; //especifica la conexión de BD a utilizar (PostgreSQL)

    protected $guarded = []; 
}
