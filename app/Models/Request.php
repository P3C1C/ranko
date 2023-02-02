<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class);
    }
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    
    public function ranks()
    {
        return $this->hasMany(Rank::class);
    }
}
