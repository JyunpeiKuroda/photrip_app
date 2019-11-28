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

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    /**
     * 一般ユーザーでも見れる
     * ペジネートして、一覧表示
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guides = Guide::with(['user'])
            ->orderBy(Guide::UPDATED_AT, 'desc')->paginate();

        return $guides;
    }

    /**
     * しおり登録
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try{
            $guide = Guide::create(array_merge($request->guide, ['user_id' => $request->user()->id]));
            $guide->overviews()->createMany($request->overview);
            $guide->places()->createMany($request->place);
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();

        return response($guide, 201);
    }

    /**
     * しおり詳細・編集データ）
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($guideId)
    {
        $guide = Guide::with(['places', 'overviews'])->get();
        $guide = $guide->find($guideId);

        return $guide;
    }

    /**
     * 編集機能
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $guide = Guide::find($id);

        DB::beginTransaction();

        try{
            $guide->title = $request->guide['title'];
            $guide->days = $request->guide['days'];

            foreach ($request->overview as $overview) {
                $guide->overviews()->overview = $overview['overview'];
                $guide->overviews()->content = $overview['content'];
                $guide->save();
            }
    
            foreach ($request->place as $place) {
                $guide->places()->place = $place['place'];
                $guide->places()->detail = $place['detail'];
                $guide->save();
            }
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();

        return response($guide, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();

        try {
            $guide = Guide::find($id);
            $guide->delete();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response(200);
    }
}
