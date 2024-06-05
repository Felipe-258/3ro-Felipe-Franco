<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogCRUD extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_user",
        "accion",
        "ip",
        "browser",
        "fecha",
    ] ;
}
