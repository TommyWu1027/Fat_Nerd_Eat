<?php

namespace App\Http\Controllers;

use App\Deliver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliverController extends Controller
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
    
    public function orderReceive(Request $request)
    {
        $deliverId = DB::table('users')->where('id',(int)($request->id))->get('type_id');
        // return $deliverId[0]->type_id;
        $status = DB::table('delivers')->where('id',$deliverId[0]->type_id)->get('status');
        // return $status[0]->status;
        if($status[0]->status == 'Free'){
            $newstatus = 'on the way to receive';
            DB::table('orders')
            ->where('id', $deliverId[0]->type_id)
            ->update(['deliver' => $request->id, 'status' => $newstatus]);
        }

        return redirect()->route('orderDetail');
    }

    public function deliverPost(Request $request)
    {
        $customer = Deliver::create([
            'name' => $request['name'],
            'status' => 'offline',
        ]);
    }

    public function add_deliver()
    {
        //
        return view('add_deliver');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deliver  $deliver
     * @return \Illuminate\Http\Response
     */
    public function show(Deliver $deliver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deliver  $deliver
     * @return \Illuminate\Http\Response
     */
    public function edit(Deliver $deliver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deliver  $deliver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deliver $deliver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deliver  $deliver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deliver $deliver)
    {
        //
    }
}
