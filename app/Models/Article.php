<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(User::class,'author_id');
    }

    public function points(){
        return $this->belongsToMany(Point::class,'')->withPivot(['user_id']);
    }

    public function point(){
        return $this->points()->avg('point');
    }


}
