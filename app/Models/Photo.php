<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $guarded = ['id'];

    protected $visible = ['file_path'];
    
    protected $keyType = 'string';

    const ID_LENGTH = 12;

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (! array_get($this->attributes, 'id')) {
            $this->setId();
        }
    }

    private function setId()
    {
        $this->attributes['id'] = $this->getRandomId();
    }

    private function getRandomId()
    {
        $characters = array_merge(
            range(0, 9), range('a', 'z'),
            range('A', 'Z'), ['-', '_']
        );

        $length = count($characters);

        $id = "";

        for ($i = 0; $i < self::ID_LENGTH; $i++) {
            $id .= $characters[random_int(0, $length - 1)];
        }

        return $id;
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function getUrlAttribute()
    {
        return Storage::cloud()->url($this->attributes['filename']);
    }
}
