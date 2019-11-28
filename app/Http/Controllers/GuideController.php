<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Overview;
use App\Models\Place;
use App\Services\GuideService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideController extends Controller
{
    private $guide_service;

    public function __construct(GuideService $guide_service)
    {
        $this->middleware('auth')->except(['index']);

        $this->guide_service = $guide_service;
    }

    /**一覧返却 */
    public function index()
    {
        return $this->guide_service->getGuideWithUser();
    }

    /**登録完了ステータス返却 */
    public function store(Request $request)
    {
        return $this->guide_service->createGuide($request);
    }

    /**しおり詳細返却 */
    public function edit($id)
    {
        return $this->guide_service->getEdittingData($id);
    }

    /**更新完了ステータス返却 */
    public function update(Request $request, $id)
    {
        return $this->guide_service->updateGuide($request, $id);
    }

    /**削除完了ステータス返却 */
    public function destroy($id)
    {
        return $this->guide_service->deleteGuide($id);
    }
}
