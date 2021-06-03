@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Store</div>

                <div class="card-body">
                    
                                                
                        <div class="form-group row">
                            <label for="Image" class="col-md-4 col-form-label text-md-right">Original Image</label>

                            <div class="col-md-6">
                            
                                <img src="{{ URL::asset('storage/'.$storeInfo->id.'/logo.jpg') }}" id="img"/>
     
                            </div>
                        </div>
                        <form method="POST" action="{{ route('storeInfoPost') }}" enctype="multipart/form-data">
                                @csrf

                        <div class="form-group row">
                            <label for="storeName" class="col-md-4 col-form-label text-md-right">storeName</label>

                            <div class="col-md-6">
                                <input id="storeName" type="text" class="form-control " name="storeName"  value="{{ $storeInfo->name }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control " name="address"  value="{{ $storeInfo->address }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="myDish" class="col-md-4 col-form-label text-md-right">myDish</label>

                            <div class="col-md-6">
                                <input type ="button"  class="btn btn-success" onclick="javascript:location.href='{{ route('myDish') }}'" value="my Dish detail"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="myOrder" class="col-md-4 col-form-label text-md-right">myOrder</label>

                            <div class="col-md-6">
                                <input type ="button"  class="btn btn-info" onclick="javascript:location.href='{{ route('myOrderList') }}'" value="my Order List"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

                            <div class="col-md-6">
                                <input id="category" type="text" class="form-control " name="category"  value="{{ $storeInfo->category }}" required autofocus>

                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Change Image</label>

                            <div class="col-md-6">
                            <input accept="image/*, image/heic, image/heif" type="file" class="form-control-file" id="image" name="image">
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
