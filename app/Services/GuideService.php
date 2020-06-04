<?php
namespace App\Services;

use App\Models\Overview;
use App\Models\Place;
use App\Repositories\GuideRepo as GuideRepository;;
use Illuminate\Http\Request;

class GuideService
{
    private $guide_repository;

    public function __construct(GuideRepository $guide_repository)
    {
        $this->guide_repository = $guide_repository;
    }


    public function createGuide(Request $request)
    {
        return $this->guide_repository->saveGuide($request);
    }

    public function updateGuide(Request $request, $id)
    {
        return $this->guide_repository->updateGuide($request, $id);
    }

    public function getGuideWithUser()
    {
        return $this->guide_repository->getGuideWithUser();
    }

    public function deleteGuide($id)
    {
        return $this->guide_repository->deleteGuide($id);
    }

    public function getEdittingData($id)
    {
        return $this->guide_repository->editGuide($id);
    }

}