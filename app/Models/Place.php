<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    protected $visible = ['place', 'detail', 'schedule', 'time', 'file_path'];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}