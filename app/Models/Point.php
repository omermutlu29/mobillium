<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    public function articles(){
        return $this->belongsToMany(Article::class,'article_points')->withPivot('user_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'article_points')->withPivot('article_id');
    }
}
