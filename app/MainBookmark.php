<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainBookmark extends Model
{
    protected $guarded = ['id', 'user_id'];

    public function placeDetails()
    {
        return $this->hasMany('App\BookmarkPlace');
    }

    public function bookmarkOverviews()
    {
        return $this->hasMany('App\BookmarkOverview');
    }
}
