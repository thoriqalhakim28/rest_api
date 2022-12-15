<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Models\Collection;
use App\Http\Resources\Collection as CollectionResource;

class CollectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();
        return $this->sendResponse(CollectionResource::collection($collections), 'Posts fetched.');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'namaKoleksi' => 'required',
            'jenisKoleksi' => 'required',
            'jumlahKoleksi' => 'required',
            'jumlahSisa' => 'required',
            'jumlahKeluar' => 'required'
        ]);

        if($validator->fails()) {
            return $this->sendError($validator->error());
        }

        $collection = Collection::create($input);
        return $this->sendResponse(new CollectionResource($collection), 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = Collection::find($id);
        if(is_null($collection)) {
            return $this->sendError('Post does not exist.');
        }

        return $this->sendResponse(new CollectionResource($collection), 'Post fetched.');
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
    public function update(Request $request, Collection $collection)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'namaKoleksi' => 'required',
            'jenisKoleksi' => 'required',
            'jumlahKoleksi' => 'required',
            'jumlahSisa' => 'required',
            'jumlahKeluar' => 'required'
        ]);

        if($validator->fails()) {
            return $this->sendError($validator->error());
        }

        $collection->namaKoleksi = $input['namaKoleksi'];
        $collection->jenisKoleksi = $input['jenisKoleksi'];
        $collection->jumlahKoleksi = $input['jumlahKoleksi'];
        $collection->jumlahSisa = $input['jumlahSisa'];
        $collection->jumlahKeluar = $input['jumlahKeluar'];
        $collection->save();

        return $this->sendResponse(new CollectionResource($collection), 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return $this->sendResponse([], 'Post deleted.');
    }

    public function getCollections()
    {
        $collections = DB::table('collections')
        ->select(
            'id',
            'namaKoleksi',
            'jenisKoleksi',
        )
        ->orderBy('id', 'asc')
        ->get();
        return response()->json($collections, 200);
    }
}
