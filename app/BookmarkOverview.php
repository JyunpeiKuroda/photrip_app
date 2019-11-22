<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookmarkOverview extends Model
{
    protected $guarded = ['id'];

    public function bookmark_main()
    {
        return $this->belongsTo('App\MainBookmark');
    }
}
