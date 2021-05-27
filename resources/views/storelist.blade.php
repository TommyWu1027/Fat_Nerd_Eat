@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Store</div>

                <div class="card-body">

                    
                    <table class="table"  width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">StoreName</th>
                                <th scope="col">StoreAddress</th> 
                                <th scope="col">Action</th>  
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($storeInfo as $store)
                        
                        <tr>
                            <th scope="row"><img src="{{ URL::asset('storage/'.$store->id.'/logo.jpg') }}" id="img"/></th>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->address }}</td>
                            <td>
                                <input type ="button"  class="btn btn-primary" onclick="javascript:location.href='http://127.0.0.1:8000/menu/{{ $store->id }}'" value="Go"></input>
                            </td>    
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                        


                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
