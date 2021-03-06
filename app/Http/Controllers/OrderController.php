<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function orderDelete(Request $request )
    {
        DB::table('orders')
            ->where('id', (int)$request['orderId'])->delete();

        return redirect()->route('myOrderList');
    }

    public function orderUpdatePost(Request $request )
    {
        $validator = Validator::make($request->all(), [
            'total' => ['required', 'numeric', 'min:1'],
        ]);
        
        // return $validator->errors();
        if ($validator->fails()) {
            return redirect()
                        ->route('menu', [
                            'storeid' => $request->get('storeid')
                        ])
                        ->withErrors($validator)
                        ->withInput();
        }

        // return $request;
        $menu = DB::table('stores')->where('id', (int)($request->storeid))->get('dish');
        // return $menu;
        $menu_arr = json_decode($menu[0]->dish, true);
        // return $menu_arr[1]["dishName"];
        // return $menu_arr;
        for($i = 0 ; $i < count($menu_arr) ; $i++){
            $dish = str_replace(' ', '_', $menu_arr[$i]["dishName"]);
            if($request[$dish] != NULL){
                $content_arr[] = array('dishName' => $dish, 'dishPrice' => $menu_arr[$i]["dishPrice"], 'quantity' => $request[$dish]);
            }
        }

        $content = json_encode($content_arr);
        // return $content;
        $customer_Id = DB::table('users')->where('id',(int)($request->id))->get('type_id');
        $address = DB::table('customers')->where('id',$customer_Id[0]->type_id)->get('address');
        $destination = $address[0]->address;

        //$storeUserID = (DB::table('users')->where([['type','=','Customer'],['type_id','=',(int)($request['storeid']]]))->get('id'))[0]->id;
        // return $destination;
        $order = DB::table('orders')->where('id', (int)$request['orderId'])
            ->update([
            'store' =>  $request['storeid'],
            'customer' => $request['id'],
            'destination' => $request['destination'],
            'content' => $content,
            'bill' => $request['total'],
            'status' => 'Finding a deliver',
        ]);
        return redirect()->route('myOrderList');
    }

    public function orderUpdateGet(Request $request )
    {
        $orderid = $request->route('orderid');
        $storeId = (DB::table('orders')->where('id', $orderid)->get('store'))[0]->store;
        $menu = DB::table('stores')->where('id', $storeId)->get('dish');
        $json_arr = json_decode($menu[0]->dish, true);
        $type_id = (DB::table('users')->where('id', (int)( Auth::user()->id ))->get('type_id'))[0]->type_id;
        $address = (DB::table('customers')->where('id', (int)( $type_id ))->get('address'))[0]->address;

        //get order details
        $order = DB::table('orders')->where('id', $orderid)->get();

        //get order dish
        $orderDish = DB::table('orders')->where('id', $orderid)->get('content');
        $orderDish_json_arr = json_decode($orderDish[0]->content, true);
        
        return view('orderUpdate', ["menu" => $json_arr, "storeid" => $storeId,"address" => $address,"orderDetail"=>$order[0],"orderDish"=>$orderDish_json_arr,"orderid"=>$orderid]);
    }

    public function myOrderList()
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
    public function orderPost_add(Request $request )
    {   
        // return $request;
        // ??????customer?????????????????????
        $validator = Validator::make($request->all(), [
            'total' => ['required', 'numeric', 'min:1'],
        ]);
        
        // return $validator->errors();
        if ($validator->fails()) {
            return redirect()
                        ->route('menu', [
                            'storeid' => $request->get('storeid')
                        ])
                        ->withErrors($validator)
                        ->withInput();
        }

        // return $request;
        $menu = DB::table('stores')->where('id', (int)($request->storeid))->get('dish');
        // return $menu;
        $menu_arr = json_decode($menu[0]->dish, true);
        // return $menu_arr[1]["dishName"];
        // return $menu_arr;
        for($i = 0 ; $i < count($menu_arr) ; $i++){
            $dish = str_replace(' ', '_', $menu_arr[$i]["dishName"]);
            if($request[$dish] != NULL){
                $content_arr[] = array('dishName' => $dish, 'dishPrice' => $menu_arr[$i]["dishPrice"], 'quantity' => $request[$dish]);
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
            'destination' => $request['destination'],
            'content' => $content,
            'bill' => $request['total'],
            'status' => 'Finding a deliver',
        ]);
        return redirect()->route('myOrderList');
    }

    public function changeStatus(Request $request)
    {
        $orderId = (DB::table('orders')->where('id', (int)$request['orderId'])->get('id'))[0]->id;
        $orderStatus = (DB::table('orders')->where('id', (int)$request['orderId'])->get('status'))[0]->status;
        $deliverId = (DB::table('users')->where('id',(int)( Auth::user()->id ))->get('type_id'))[0]->type_id;

        if($orderStatus=="On the way to receive"){
            DB::table('orders')
            ->where('id', (int)$request['orderId'])
            ->update(['status' => 'On the way to customer']);}

        else if($orderStatus=="On the way to customer"){
            DB::table('orders')
            ->where('id', (int)$request['orderId'])
            ->update(['status' => 'Arrived']);}

        else if($orderStatus=="Arrived"){
            DB::table('orders')
            ->where('id', (int)$request['orderId'])
            ->update(['status' => 'Done']);
            
            DB::table('delivers')
            ->where('id', $deliverId)
            ->update(['status' =>  'Free']);
        }

        return redirect()->route('orderDetail',['orderid'=>$orderId]);
        
    }

    public function orderDetail(Request $request)
    {
        $orderId = $request->route('orderid');
        $order = DB::table('orders')->where('id', $orderId)->get();

        $menu = DB::table('orders')->where('id', $orderId)->get('content');
        $json_arr = json_decode($menu[0]->content, true);
        // return $json_arr;
        
        return view('orderDetail', ['order' => $order[0],'content'=> $json_arr]);
    }

    public function orderList_Deliver()
    {
        $orderList = DB::table('orders')->get();
        
        $deliverId = DB::table('users')->where('id',(int)( Auth::user()->id ))->get('type_id');
        $status = (DB::table('delivers')->where('id',$deliverId[0]->type_id)->get('status'))[0]->status;
        if( $status!='Free'){
            return redirect()->route('orderDetail',['orderid'=>$status]);
        }

        return view('orderList_D', ['orderList' => $orderList]);
    }

    // public function orderList_Store()
    // {
    //     $orderList = DB::table('orders')->get();
    //     return view('orderList_D', ['orderList' => $orderList]);
    // }

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
