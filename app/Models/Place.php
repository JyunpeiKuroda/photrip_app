<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    protected $visible = [
        'place', 'detail'
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}