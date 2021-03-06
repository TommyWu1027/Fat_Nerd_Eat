@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Store</div>

                <div class="card-body">
                
                  
                       
                        <form method="POST" action="{{ route('storeinfoSearch') }}" style="margin:0px;display:inline">
                            @csrf
                        <div class="form-group row">
                            
                            <div class="col-xs-3">
                                <input id="category" type="text" class="form-control " name="category"  placeholder="search">
                            </div>
                            <!-- <select for="category" class="form-select">
                                <option value="StoreName">Store Name</option>
                                <option value="StoreCategory">Store Category</option>
                            </select>   -->
                            <button for="category" style="margin-left: 5px;" class=" btn btn-primary">Search</button>
                            
                        </div>
                        
                        </form>
                    
                    
                    <table class="rwd-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th> 
                                <th scope="col">Action</th>  
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($storeInfo as $store)
                        @if ( $store->dish != null)
                        <tr>
                            <td data-th="Store"><img src="{{ URL::asset('storage/'.$store->id.'/logo.jpg') }}" id="img"/></th>
                            <td data-th="Name">{{ $store->name }}</td>
                            <td data-th="Address"> {{ $store->address }}</td>
                            <td data-th="Action">
                                <input type ="button"  class="btn btn-primary" onclick="javascript:location.href='./menu/{{ $store->id }}'" value="Go"></input>
                            </td>    
                        </tr>
                        @endif
                    @endforeach
                        </tbody>
                    </table>
                        


                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
