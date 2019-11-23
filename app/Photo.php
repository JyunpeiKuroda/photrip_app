<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = ['id'];

    public function bookmark_place()
    {
        return $this->belongsTo(BookmarkPlace::class);
    }
}
