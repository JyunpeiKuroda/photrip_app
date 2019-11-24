<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuideResource extends JsonResource
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
            'id' => $this->id,
            'guide_title' => $this->guide_title,
            'guide_days' => $this->guide_days,
            'overviewForm' => [
                BookmarkOverviewResource::collection($this->overviewForm)
            ],
            'placeForm' => 
            [
                BookmarkPlaceResource::collection($this->placeForm)
            ],
        ];
    }
}
