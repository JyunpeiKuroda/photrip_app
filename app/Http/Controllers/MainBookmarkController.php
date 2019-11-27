<?php

namespace App\Http\Controllers;

use App\Services\BookmarkService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        return $this->bookmark_service->ComposeGuide($request);
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
