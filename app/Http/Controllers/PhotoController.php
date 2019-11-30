<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * S3 アップロード
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {

        $image = $request->file('s3');
        $filename = ((string)(uniqid("img_"))) .".". $image->getClientOriginalExtension();
        $filepath = Storage::disk('s3')->putFileAs('uploads', $image, $filename, 'public');
        $url = Storage::disk('s3')->url($filepath);

        return response($url, 201);
    }

    /**
     * 画像取得
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disk = Storage::disk('s3');

        try {
            $content = $disk->get($id);
            $mimeType = $disk->mimeType($id);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 404);
        }

        return response($content)->header('Content-Type', $mimeType);
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
