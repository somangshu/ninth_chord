<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';

    protected $fillable = ['name', 'status'];

    protected $hidden = ['created_at', 'updated_at'];

    public function tracks()
    {
    	return $this->belongsToMany('App\Track', 'genre_track', 'genre_id', 'track_id');
    }
}
