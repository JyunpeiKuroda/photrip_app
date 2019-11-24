<?php

namespace App\Http\Controllers;

use App\Models\BookmarkOverview;
use App\Models\BookmarkPlace;
use App\Models\MainBookmark;
use App\Services\BookmarkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainBookmarkController extends Controller
{
    private $bookmark_service;

    public function __construct(BookmarkService $bookmark_service)
    {
        $this->bookmark_service = $bookmark_service;
    }

    /**
     * 一覧取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $guide = MainBookmark::join('bookmark_overviews', 'main_bookmarks.id', '=', 'bookmark_overviews.main_bookmark_id')
            // ->join('bookmark_places', 'main_bookmarks.id', '=', 'bookmark_places.main_bookmark_id')
            // ->get();
            
        return $this->bookmark_service->getAllBookmarks();

    }

    /**
     * しおり作成処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $form = $request->all();

        DB::beginTransaction();

        try {
            
            // しおり固定作成
            $bookmark = MainBookmark::create($request->get('bookmark', []));

            // 概要
            for ($i = 0, $size = count($form['overviewForm']); $size > $i; $i++) {
                $overview                   = 'overview'.$i;
                $overview                   = new BookmarkOverview();
                $overview->overview         = $form['overviewForm'][$i]['overview'];
                $overview->content          = $form['overviewForm'][$i]['content'];
                $overview->main_bookmark_id = $bookmark->id;
                $overview->save();
            }

            // 場所詳細
            for ($i = 0, $size = count($form['placeForm']); $size > $i; $i++) {
                $place                   = 'place'.$i;
                $place                   = new BookmarkPlace();
                $place->place            = $form['placeForm'][$i]['place'];
                $place->place_detail     = $form['placeForm'][$i]['detail'];
                $place->main_bookmark_id = $bookmark->id;
                $place->save();
            }

        } catch ( Exception $e ) {

            DB::rollback();
            return back()->withInput();

        }

        DB::commit();

        return response()->json([], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
