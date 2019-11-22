<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainBookmark extends Model
{
    protected $guarded = ['id', 'user_id'];

    public function place_detail()
    {
        return $this->hasMany('App\BookmarkPlace');
    }

    public function bookmark_overview()
    {
        return $this->hasMany('App\BookmarkOverview');
    }
}
