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

    public function dishPost_add(Request $request)
    {   
        // 前端選擇的店家的舊菜單
        $storeId = DB::table('users')->where('id', (int)($request->id))->get('type_id');
        $oldmenu=DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');
        // return $oldmenu[0]->dish;
        // 新增菜色
        if($oldmenu[0]->dish != NULL){
            $json_arr = json_decode($oldmenu, true);
            $json_arr[] = array('dishName' => $request->dishName, 'dishPrice' => $request->dishPrice);
        }
        else $json_arr[] = array('dishName' => $request->dishName, 'dishPrice' => $request->dishPrice);

        // 回傳至資料庫
        $newmenu = json_encode($json_arr);
        DB::table('stores')
        ->where('id', $storeId[0]->type_id)
        ->update(['dish' => $newmenu]);
        $oldmenu=DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');
        return $oldmenu;
    }

    public function dishPost_update(Request $request)
    {   
        // 前端選擇的店家的舊菜單
        $storeId=DB::table('users')->where('id', $request->id)->get('type_id');
        $oldmenu=DB::table('stores')->where('id', $storeId)->get('dish');

        // 更新價錢
        $json_arr = json_decode($oldmenu, true);
        foreach ($json_arr as $key => $value) {
            if ($value['dishName'] == $request->dishName) {
                $json_arr[$key]['dishPrice'] = $request->dishPrice;
            }
        }
        // 回傳至資料庫
        $newmenu = json_encode($json_arr);
        DB::table('stores')
        ->where('id', $storeId)
        ->update(['dish' => $newmenu]);
    }

    public function dishPost_delete(Request $request)
    {   
        // 前端選擇的店家的舊菜單
        $storeId=DB::table('users')->where('id', $request->id)->get('type_id');
        $oldmenu=DB::table('stores')->where('id', $storeId)->get('dish');

        // 刪除菜色
        $json_arr = json_decode($oldmenu, true);
        $arr_index = array();
        foreach ($json_arr as $key => $value)
        {
            if ($value['dishName'] == $request->dishName)
            {
                $arr_index[] = $key;
            }
        }
        foreach ($arr_index as $i)
        {
            unset($json_arr[$i]);
        }
        $json_arr = array_values($json_arr);

        // 回傳至資料庫
        $newmenu = json_encode($json_arr);
        DB::table('stores')
        ->where('id', $storeId)
        ->update(['dish' => $newmenu]);
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

    public function dishPost(Request $request)
    {
        //
        return view('update_dish');
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
