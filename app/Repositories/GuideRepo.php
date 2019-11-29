<?php

namespace App\Repositories;

use App\Models\Guide;
use App\Models\Overview;
use App\Models\Place;
use App\Repositories\Interfaces\GuideRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuideRepo implements GuideRepositoryInterface{

    public function __construct(
        Guide $guide_model,
        Place $place_model,
        Overview $overview_model
    )
    {
        $this->guide_model = $guide_model;
        $this->place_model = $place_model;
        $this->overview_model = $overview_model;
    }

    public function findById($id)
    {
        return Guide::find($id);
    }

    public function deleteGuide($id) 
    {
        $guide = $this->findById($id);

        DB::beginTransaction();

        try {
            $guide->delete();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response(200);
    }

    public function saveGuide(Request $request)
    {
        DB::beginTransaction();

        try{
            $guide = $this->guide_model::create(array_merge($request->guide, ['user_id' => $request->user()->id]));
            $guide->overviews()->createMany($request->overview);
            $guide->places()->createMany($request->place);
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();

        return response($guide, 201);
    }

    /** 全取得（ユーザー付き） */
    public function getGuideWithUser()
    {
        return Guide::with(['user'])->orderBy(Guide::UPDATED_AT, 'desc')->paginate();
    }

    /**編集機能（delete + create）かなり無理矢理 */
    public function updateGuide(Request $request, $id)
    {
        $this->deleteGuide($id);
        $this->saveGuide($request);

        return response(201);
    }

    public function editGuide($id)
    {
        return Guide::with(['places', 'overviews'])->get()->find($id);
    }

}