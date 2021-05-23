<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $order = Order::create([
            'store' => $request['storeid'],
            'customer' => $request['id'],
            'content' => $content,
        ]);
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
