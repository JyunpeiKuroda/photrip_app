<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookmarkPlace extends Model
{
    protected $guarded = ['id'];

    public function bookmark_main()
    {
        return $this->belongsTo('App\MainBookmark');
    }

    public function photo()
    {
        return $this->hasMany('App\Photo');
    }
}
