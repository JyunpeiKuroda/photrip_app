<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    protected $guarded = [];

    public $timestamps=false;

    protected $visible = [
        'overview', 'content', 'id'
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
