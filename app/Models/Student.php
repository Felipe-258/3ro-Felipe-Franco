<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assist;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni', 'name', 'surname', 'birth', 'assist', 'year', '_token',
    ];
    public function assists()
    {
        return $this->hasmany(Assist::class);
    }

    public function notes()
    {
        return $this->hasmany(Note::class);
    }
}
