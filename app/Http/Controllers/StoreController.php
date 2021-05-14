<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=DB::table('stores')->get();
        return view('storelist', ['storename' => $posts]);
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

    public function dishPost(Request $request)
    {   
        // 前端選擇的店家的舊菜單
        $storeId=DB::table('users')->where('id', $request->id)->get('type_id');
        $originDish=DB::table('stores')->where('id', $storeId)->get('dish');

        // 舊菜單+新菜單
        

        // 回傳至資料庫
        DB::table('stores')
        ->where('id', $request->id)
        ->update(['dish' => ]);
    }

    public function storePost(Request $request)
    {
        $store = Store::create([
            'name' => $request['name'],
            'dish' => $request['dish'],
            'address' => $request['address'],
        ]);
    }

    public function addstore(Request $request)
    {
        //
        return view('add_store');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
