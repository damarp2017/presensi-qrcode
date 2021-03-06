<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade_id',
        'nisn',
        'name',
        'address',
        'phone',
        'gender',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function attendances(){
      return $this->hasMany(Attendance::class);
    }
}
