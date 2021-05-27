<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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

    public function myOrderList(Request $request)
    {
        $type_id = (DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type_id'))[0]->type_id;
        $type = (DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type'))[0]->type;
        $userId = (int)( Auth::user()->id );
        if($type=='Store'){
            $orderList = DB::table('orders')->where('store', $type_id )->get();
            
        }
        else if($type=='Customer'){
            $orderList = DB::table('orders')->where('customer', $userId)->get();
        }
        else if($type=='Deliver'){
            $orderList = DB::table('orders')->where('deliver', $userId )->get();
            
        }
       
        return view('myOrderList', ['myOrderList' => $orderList]);
        
        
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderPost_add(Request $request)
    {   
        // return $request;
        $menu = DB::table('stores')->where('id', (int)($request->storeid))->get('dish');
        // return $menu;
        $menu_arr = json_decode($menu[0]->dish, true);
        // return $menu_arr[1]["dishName"];
        // return $menu_arr;
        for($i = 0 ; $i < count($menu_arr) ; $i++){
            $dish = str_replace(' ', '_', $menu_arr[$i]["dishName"]);
            if($request[$dish] != NULL){
                $content_arr[] = array('dishName' => $dish, 'quantity' => $request[$dish]);
            }
        }
        $content = json_encode($content_arr);
        // return $content;
        $customer_Id = DB::table('users')->where('id',(int)($request->id))->get('type_id');
        $address = DB::table('customers')->where('id',$customer_Id[0]->type_id)->get('address');
        $destination = $address[0]->address;

        //$storeUserID = (DB::table('users')->where([['type','=','Customer'],['type_id','=',(int)($request['storeid']]]))->get('id'))[0]->id;
        // return $destination;
        $order = Order::create([
            'store' =>  $request['storeid'],
            'customer' => $request['id'],
            'destination' => $destination,
            'content' => $content,
            'status' => 'on the way to receive',
        ]);
    }


    public function orderList_Deliver()
    {
        $orderList = DB::table('orders')->get();
        return view('orderList_D', ['orderList' => $orderList]);
    }

    public function orderList_Store()
    {
        $orderList = DB::table('orders')->get();
        return view('orderList_D', ['orderList' => $orderList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
