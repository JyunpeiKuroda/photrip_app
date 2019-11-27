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
            ->orderBy(Guide::CREATED_AT, 'desc')->paginate();

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
            $guide = new Guide(array_merge($request->guide, ['user_id' => $request->user()->id]));
            $guide->save();
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
