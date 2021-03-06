<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = ['id'];
    
    protected $visible = [
        'id', 'title', 'days', 'user', 'overviews', 'places'
    ];

    const ID_LENGTH = 15;


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
            range(0, 15), range('a', 'z'),
            range('A', 'Z'), ['-', '_']
        );

        $length = count($characters);

        $id = "";

        for ($i = 0; $i < self::ID_LENGTH; $i++) {
            $id .= $characters[random_int(0, $length - 1)];
        }

        return $id;
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function overviews()
    {
        return $this->hasMany(Overview::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
