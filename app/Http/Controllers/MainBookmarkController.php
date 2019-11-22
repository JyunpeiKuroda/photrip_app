<?php

namespace App\Http\Controllers;

use App\BookmarkOverview;
use App\BookmarkPlace;
use App\MainBookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainBookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * しおり作成処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $mainBookmark     = new MainBookmark();
            $bookmarkOverview = new BookmarkOverview();
            $bookmarkPlace    = new BookmarkPlace();

            // しおり固定フォーム
            $bookmark = $mainBookmark::create([
                'bookmark_title' => $request->title,
                'bookmark_days'  => $request->days
            ]);

            // しおり概要フォーム
            foreach($request->overviewForm as $form) {
                $bookmarkOverview->main_bookmark_id = $bookmark->id;
                $bookmarkOverview->overview_title   = $form['overview'];
                $bookmarkOverview->overview_content = $form['content'];
            }
    
            // しおり場所詳細フォーム
            foreach($request->placeForm as $form) {
                $bookmarkPlace->main_bookmark_id = $bookmark->id;
                $bookmarkPlace->place            = $form['place'];
                $bookmarkPlace->place_detail     = $form['detail'];
            }

            $bookmarkOverview->save();
            $bookmarkPlace->save();

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
