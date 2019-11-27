<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookmarkPlaceResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'               => $this->id,
            'main_bookmark_id' => $this->main_bookmark_id,
            'place'            => $this->place,
            'detail'           => $this->place_detail
        ];
    }
}
