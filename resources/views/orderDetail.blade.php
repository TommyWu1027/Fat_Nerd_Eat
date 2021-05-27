@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Detail</div>

                <div class="card-body">
                    
                {{(DB::table('stores')->where('id', (int)($myOrder->store ))->get('name'))[0]->name}}

                        <form method="POST" action="{{ route('changeStatus') }}" enctype="multipart/form-data">
                                @csrf

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Store Name</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{ $storeInfo->name }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Customer</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control " name="address"  value="{{ $storeInfo->address }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Destination</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{ $storeInfo->name }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Deliver</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{ $storeInfo->name }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Time</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{ $storeInfo->name }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Content</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{ $storeInfo->name }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{ $storeInfo->name }}" required autofocus>

                            </div>
                        </div>
        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    modify
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
