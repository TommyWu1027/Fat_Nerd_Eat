<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeInfo=DB::table('stores')->get();
        // return $name;
        
        return view('storelist', ['storeInfo' => $storeInfo]);
    }

   
    public function storeinfoSearch(Request $request)
    {   
        // $storeInfo = DB::table('stores')->where('name', 'LIKE', '%'.$request->category.'%')->get();
        // return $storeInfo;
        if($request->category == NULL){
            $storeInfo = DB::table('stores')->get();
            return view('storelist', ['storeInfo' => $storeInfo]);
        }
        elseif((DB::table('stores')->where('name', 'LIKE', '%'.$request->category.'%')->get()) != '[]'){
            $storeInfo = DB::table('stores')->where('name', 'LIKE', '%'.$request->category.'%')->get();
            // return $storeInfo;
            return view('storelist', ['storeInfo' => $storeInfo]);
        }
        elseif((DB::table('stores')->where('category', 'LIKE', '%'.$request->category.'%')->get()) != '[]'){
            $storeInfo = DB::table('stores')->where('category', 'LIKE', '%'.$request->category.'%')->get();
            // return $storeInfo;
            return view('storelist', ['storeInfo' => $storeInfo]);
        }
        else{
            $storeInfo = [];
            return view('storelist', ['storeInfo' => $storeInfo]);
        }
        // elseif((DB::table('stores')->where('category',$request->category)->get()) != NULL){

        // }
        // if($request->category != NULL){
        //     if((DB::table('stores')->where('name',$request->category)->get()) != NULL){
        //         $storeInfo = DB::table('stores')->where('name', $request->category)->get();
        //     }else((DB::table('stores')->where('category',$request->category)->get()) != NULL){
        //         $storeInfo = DB::table('stores')->where('category', $request->category)->get();
        //     }
        // }
        // else{
        //     $storeInfo = DB::table('stores')->get();
        // }

        // return view('storelist', ['storeInfo' => $storeInfo]);
    }

    public function storeHome()
    {
        $storeId = DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type_id');
        $storeInfo = DB::table('stores')->where('id', $storeId[0]->type_id)->get();
        
        
        return view('storeHome', ['storeInfo' => $storeInfo[0]]);
    }

    public function storeInfoPost(Request $request)
    {
        $storeId = DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type_id');
        $storeInfo = DB::table('stores')->where('id', $storeId[0]->type_id)->get();

        DB::table('stores')
        ->where('id', $storeId[0]->type_id)
        ->update(['name' => $request->storeName,'address' => $request->address,'category' => $request->category]);

        

        //儲存上傳的圖片

        $file_path ='storage/'.$storeId[0]->type_id;

        if (request()->hasFile('image'))
        {
            if(!file_exists($file_path)){
                mkdir($file_path);}
            $imageURL = request()->file('image')->storeAs('public/'.$storeId[0]->type_id, 'logo.jpg');

            //縮放圖片大小        
            Image::make(storage_path('app/public/' .$storeId[0]->type_id .'/logo.jpg'))
            ->resize(150, 100)
            ->save(storage_path('app/public/'.$storeId[0]->type_id .'/logo.jpg'));
        
        }

        
        
        return redirect()->route('storeHome');
    }

    public function menu(Request $request)
    {
        $storeId = $request->route('storeid');
        $menu = DB::table('stores')->where('id', $storeId)->get('dish');
        $json_arr = json_decode($menu[0]->dish, true);
        $type_id = (DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type_id'))[0]->type_id;
        $address = (DB::table('customers')->where('id', (int)( $type_id ))->get('address'))[0]->address;

        return view('menu', ["menu" => $json_arr, "storeid" => $storeId,"address" => $address]);
    }

    public function myDish(Request $request)
    {
        $storeId = Auth::user()->type_id;
        $menu = DB::table('stores')->where('id', $storeId)->get('dish');
        $json_arr = json_decode($menu[0]->dish, true);

        return view('myDish', ["menu" => $json_arr, "storeid" => $storeId]);
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
        $storeId = DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type_id');
        $oldmenu=DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');

        //儲存上傳的圖片

        $file_path ='storage/'.$storeId[0]->type_id;

        if (request()->hasFile('image'))
        {
            if(!file_exists($file_path)){
                mkdir($file_path);}
            $imageURL = request()->file('image')->storeAs('public/'.$storeId[0]->type_id, $request->dishName.'.jpg');

             //縮放圖片大小        
            Image::make(storage_path('app/public/' .$storeId[0]->type_id .'/'. $request->dishName.'.jpg'))
            ->resize(150, 100)
            ->save(storage_path('app/public/'.$storeId[0]->type_id .'/'. $request->dishName.'.jpg'));
            
        }
        
        // 檢查是法有相同名稱的產品
        $json_arr = json_decode($oldmenu[0]->dish, true);
        $i = 0;
        $if_repeat = false;
        foreach ((array)$json_arr as $key) {
            if ($key['dishName'] == $request->dishName) {
                $json_arr[$i]['dishPrice'] = $request->dishPrice;
                $if_repeat = true ; 
            }
            $i++;
        }

        if($if_repeat){

            // 回傳至資料庫
            $newmenu = json_encode($json_arr);
            DB::table('stores')
            ->where('id', $storeId[0]->type_id)
            ->update(['dish' => $newmenu]);
            $oldmenu=DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');
            return redirect()->route('myDish');
        }
        
        // $json_arr = json_decode($oldmenu[0]->dish, true);
        // return $json_arr[0]['dishName'];
        // 新增菜色
        if($oldmenu[0]->dish != NULL){
            $json_arr = json_decode($oldmenu[0]->dish, true);
            $json_arr[] = array('dishName' => $request->dishName, 'dishPrice' => $request->dishPrice);
        }
        else $json_arr[] = array('dishName' => $request->dishName, 'dishPrice' => $request->dishPrice);
        // 回傳至資料庫
        $newmenu = json_encode($json_arr);  

        

        

        DB::table('stores')
        ->where('id', $storeId[0]->type_id)
        ->update(['dish' => $newmenu]);
        $oldmenu=DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');

       

        return redirect()->route('myDish');
        return $oldmenu;
    }

    public function dishPost_update(Request $request)
    {   

        
        // 前端選擇的店家的舊菜單
        $storeId = DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type_id');
        $oldmenu = DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');

        // 更新價錢
        $json_arr = json_decode($oldmenu[0]->dish, true);
        $i = 0;
        foreach ($json_arr as $key) {
            if ($key['dishName'] == $request->dishName) {
                $json_arr[$i]['dishPrice'] = $request->dishPrice;
            }
            $i++;
        }
        // 回傳至資料庫
        $newmenu = json_encode($json_arr);
        DB::table('stores')
        ->where('id', $storeId[0]->type_id)
        ->update(['dish' => $newmenu]);
        $oldmenu=DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');

        //新增圖片

        $file_path ='storage/'.$storeId[0]->type_id;

        if (request()->hasFile('image'))
        {
            if(!file_exists($file_path)){
                mkdir($file_path);}
            $imageURL = request()->file('image')->storeAs('public/'.$storeId[0]->type_id, $request->dishName.'.jpg');

            //縮放圖片大小        
            Image::make(storage_path('app/public/' .$storeId[0]->type_id .'/'. $request->dishName.'.jpg'))
            ->resize(150, 100)
            ->save(storage_path('app/public/'.$storeId[0]->type_id .'/'. $request->dishName.'.jpg'));

        
        }

        
        return redirect()->route('myDish');
        return $oldmenu;
    }

    public function dishPost_delete(Request $request)
    {   
        // 前端選擇的店家的舊菜單
        $storeId = DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type_id');
        $oldmenu = DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');

        // 刪除菜色
        $json_arr = json_decode($oldmenu[0]->dish, true);
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
        ->where('id', $storeId[0]->type_id)
        ->update(['dish' => $newmenu]);
        $oldmenu=DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');

        return redirect()->route('myDish');
        return $oldmenu;
    }

    public function storePost(Request $request)
    {
        $store = Store::create([
            'name' => $request['name'],
            'dish' => $request['dish'],
            'address' => $request['address'],
        ]);
    }

    public function addstore()
    {
        //
        return view('add_store');
    }

    public function dish_add()
    {
        //
        
        return view('add_dish');
    }

    public function dish_update(Request $request)
    {
        
        //
        $storeId = DB::table('users')->where('id', (int)(Auth::user()->id))->get('type_id');
        $oldmenu = DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');
        $json_arr = json_decode($oldmenu[0]->dish, true);
        $dishNameChoose = $request->route('dishName');
        
        foreach ($json_arr as $dish) {
            if ($dish['dishName']==$dishNameChoose){
                $dishName = $dish['dishName'];
                $dishPrice = $dish['dishPrice'];
            }
        }
        // return $json_arr;
        return view('update_dish', ['dishName' => $dishName,'dishPrice'=> $dishPrice,'storeId' => $storeId[0]->type_id ]);
    }

    public function dish_delete()
    {
        //
        $storeId = DB::table('users')->where('id', (int)(Auth::user()->id))->get('type_id');
        $oldmenu = DB::table('stores')->where('id', $storeId[0]->type_id)->get('dish');
        $json_arr = json_decode($oldmenu[0]->dish, true);
        // return $json_arr;
        return view('delete_dish', ['dishName' => $json_arr]);
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
