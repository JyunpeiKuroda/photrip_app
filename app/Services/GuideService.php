<?php
namespace App\Services;

use App\Models\Overview;
use App\Models\Place;
use Illuminate\Http\Request;

class GuideService 
{

    private $place_model;
    private $overview_model;

    public function __construct(Overview $overview_model, Place $place_model)
    {
        $this->overview_model = $overview_model;
        $this->place_model = $place_model;
    }

    /** 場所登録 */
    public function placeRegister(int $guideId, $placeGroup)
    {
        dump($guideId);
        dump($placeGroup);
    }
}