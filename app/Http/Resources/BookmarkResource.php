<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'days'      => $this->days,
            // 'overviews' => BookmarkOverviewResource::collection($this->overviewForm),
            // 'places'    => BookmarkPlaceResource::collection($this->placeForm)
        ];
    }
}
