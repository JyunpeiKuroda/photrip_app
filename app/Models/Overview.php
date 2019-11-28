<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    protected $guarded = ['id'];

    public $timestamps=false;

    protected $visible = [
        'overview', 'content'
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
