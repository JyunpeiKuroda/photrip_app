<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookmarkPlace extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'main_bookmark_id',
        'place',
        'place_detail'
    ];

    public function bookmarkMain()
    {
        return $this->belongsTo('App\MainBookmark');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
