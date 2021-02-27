<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'author_id'];
    protected $primaryKey = 'id';

    protected $appends = [
        'average_rating'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function points()
    {
        return $this->belongsToMany(Point::class, 'article_points', 'article_id', 'point_id');
    }


    public function getAverageRatingAttribute()
    {
        $totalPoint = 0;
        $points = $this->points()->get();
        if (count($points) > 0) {
            $thirty = (floor(count($points) * 0.3));
            $seventy = count($points) - $thirty;
            for ($i = 0; $i < $thirty; $i++) {
                $totalPoint = $totalPoint + ($points[$i]->point * 2);
            }
            for (; $i < count($points); $i++) {
                $totalPoint = $totalPoint + $points[$i]->point;
            }
            return $this->attributes['average_rating'] = ($totalPoint / (($thirty * 2) + $seventy));
        }
        return $this->attributes['average_rating'] = 0;

    }


}
