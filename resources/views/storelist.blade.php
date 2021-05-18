@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Store</div>

                <div class="card-body">

                    
                    
                    @foreach($storeInfo as $store)
                        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/menu/{{ $store->id }}'" value="{{ $store->name }} {{ $store->address }}"></input>
                    @endforeach
                        


                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
