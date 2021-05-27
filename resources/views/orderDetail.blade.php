@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Detail</div>

                <div class="card-body">
                    
                {{(DB::table('users')->where('id', (int)($order->deliver ))->get('name'))[0]->name}}

                        <form method="POST" action="{{ route('changeStatus') }}" enctype="multipart/form-data">
                                @csrf

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Store Name</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{(DB::table('stores')->where('id', (int)($order->store ))->get('name'))[0]->name}}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Customer</label>

                            <div class="col-md-6">
                                <input id="Customer" type="text" class="form-control " name="Customer"  value="{{(DB::table('users')->where('id', (int)($order->customer ))->get('name'))[0]->name}}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Destination</label>

                            <div class="col-md-6">
                                <input id="Destination" type="text" class="form-control " name="Destination"  value="{{ $order->destination }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Deliver</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{(DB::table('users')->where('id', (int)($order->deliver ))->get('name'))[0]->name}}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Time</label>

                            <div class="col-md-6">
                                <input id="Time" type="text" class="form-control " name="Time"  value="{{ $order->time }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Content</label>

                            <div class="col-md-6">
                                <input id="Content" type="text" class="form-control " name="Content"  value="{{ $order->content }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6">
                                <input id="Status" type="text" class="form-control " name="Status"  value="{{ $order->status }}" required autofocus>

                            </div>
                        </div>
        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    confirm
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
