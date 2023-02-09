<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public $guarded = [];
}
