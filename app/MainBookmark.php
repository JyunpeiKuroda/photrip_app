<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainBookmark extends Model
{
    protected $guarded = ['id', 'user_id'];

    public function placeDetails()
    {
        return $this->hasMany(BookmarkPlace::class);
    }

    public function bookmarkOverviews()
    {
        return $this->hasMany(BookmarkOverview::class);
    }
}
