<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';

    protected $fillable = ['title', 'rating'];

    protected $hidden = ['created_at', 'updated_at'];

    public function genres()
    {
    	return $this->belongsToMany('App\Genre', 'genre_track', 'track_id', 'genre_id');
    }
}
