<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assist;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni', 'name', 'surname', 'birth', 'assist', '_token',
    ];
    public function assists()
    {
        return $this->hasmany(Assist::class);
    }
}
