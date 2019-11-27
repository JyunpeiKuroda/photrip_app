<?php

namespace App\Repositories;

use App\Models\MainBookmark as BookmarkModel;
use App\Models\BookmarkPlace as PlaceModel;
use App\Models\BookmarkOverview as OverviewModel;
use App\Services\Interfaces\BookmarkRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Bookmark implements BookmarkRepositoryInterface
{
    private $bookmark_model;

    public function __construct(
        BookmarkModel $bookmark_model, 
        PlaceModel $place_model, 
        OverviewModel $overview_model
    )
    {
        $this->bookmark_model = $bookmark_model;
        $this->place_model = $place_model;
        $this->overview_model = $overview_model;
    }

    public function getAll()
    {
        return $this->bookmark_model->all();
    }

    public function getIdBookmark(int $id)
    {
        return $this->bookmark_model->findOrFail($id);   
    }

    public function compose(Request $request)
    {
        $form = $request->all();
 
        DB::beginTransaction();
 
        try {
            
            // しおり固定作成
            $bookmark = $this->bookmark_model::create($request->get('bookmark', []));
 
            // 概要
            if (count($form['overviewForm']) > 0) {
                for ($i = 0, $size = count($form['overviewForm']); $size > $i; $i++) {
                    $overview                   = 'overview'.$i;
                    $overview                   = new $this->overview_model;
                    $overview->overview         = $form['overviewForm'][$i]['overview'];
                    $overview->content          = $form['overviewForm'][$i]['content'];
                    $overview->main_bookmark_id = $bookmark->id;
                    $overview->save();
                }
            }
 
            // 場所詳細
            if (count($form['placeForm']) > 0) {
                for ($i = 0, $size = count($form['placeForm']); $size > $i; $i++) {
                    $place                   = 'place'.$i;
                    $place                   = $this->place_model;
                    $place->place            = $form['placeForm'][$i]['place'];
                    $place->place_detail     = $form['placeForm'][$i]['detail'];
                    $place->main_bookmark_id = $bookmark->id;
                    $place->save();
                }
            }
 
        } catch ( Exception $e ) {
 
            DB::rollback();
            return back()->withInput();
 
        }
 
        DB::commit();
 
        return response('', Response::HTTP_OK);
    }
}