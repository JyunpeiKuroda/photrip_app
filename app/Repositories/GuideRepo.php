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

    public function PlaceFindById()
    {

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

    /**　編集機能 
     * ・リレーションされているPlace / OverviewのIDを保管
     * ・更新するごとにそのIDを配列から削除
     * ・残ったID = 既存のものを削除しているので削除する
    */
    public function updateGuide(Request $request, $id)
    {

        DB::beginTransaction();

        try{

            $guide = $this->guide_model::find($id);
            $guide->fill($request->guide)->save();

            /** 概要の編集 */
            $overviewAllIds = $this->overview_model->pluck('id');
            foreach ($request->overview as $overviewData) {
                $overview = $this->overview_model::find($overviewData['id']) ?: new $this->overview_model;
                /** 新規作成 */
                if (is_null($overview->id)) {
                    $guide->overviews()->create($overviewData);
                } else {
                    $overview->fill([
                        'overview' => $overviewData['overview'],
                        'content' => $overviewData['content']
                    ]);
                    $overview->save();

                    $overviewAllIds = $overviewAllIds->diff([(int)$overviewData['id']]);
                }
            }
            
            foreach ($overviewAllIds as $id)
            {
                $overview = $this->overview_model::find($id);
                if (!empty($overview)) $overview->delete();
            }

            /** 場所の編集 */
            $placeAllIds = $this->place_model->pluck('id');
            foreach ($request->place as $placeData) {
                $place = $this->place_model::find($placeData['id']) ?: new $this->place_model;
                /** 新規作成 */
                if (is_null($place->id)) {
                    $guide->places()->create($placeData);
                } else {
                    $place->fill([
                        'place'     => $placeData['place'],
                        'detail'    => $placeData['detail'],
                        'schedule'  => $placeData['schedule'],
                        'time'      => $placeData['time'],
                        'file_path' => $placeData['file_path']
                    ]);
                    $place->save();


                    $placeAllIds = $placeAllIds->diff([(int)$placeData['id']]);
                }
            }

            foreach ($placeAllIds as $id)
            {
                $place = $this->place_model::find($id);
                if (!empty($place)) $place->delete();
            }
            
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();

        return response(200);
    }

    public function editGuide($id)
    {
        return Guide::with(['places', 'overviews'])->get()->find($id);
    }

}