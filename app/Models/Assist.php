<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Assist extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'assist',
    ];
    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
}
