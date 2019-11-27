<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarkOverview extends Model
{
    protected $guarded = ['id'];

    public $timestamps=false;

    public function bookmark_main()
    {
        return $this->belongsTo(MainBookmark::class);
    }
}
