@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">orderReceive</div>

                <div class="card-body">
                   

                            <div class="form-group row" style="margin-left: auto;margin-right: auto;">


                                <table class="rwd-table">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                                            <th>StoreImage</th>
                                            <th>Store</th>
                                            <th>destination</th>                        
                                            <th>Receive</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($orderList as $order)
                                            @if ( $order->status=="Finding a deliver" )
                                            
                                            <tr>
                                            <td data-th="ID" >{{$order->id}}</td>
                                            <td data-th="StoreImage"><img src="{{ URL::asset('storage/'.$order->store.'/logo.jpg') }}" id="img"/></td>
                                            <td data-th="Store">{{(DB::table('stores')->where('id', (int)($order->store ))->get('name'))[0]->name}}</td>
                                            <td data-th="destination">{{$order->destination}}</td>

                                            
                                            <td data-th="Receive">
                                            
                                            <form method="POST" action="{{ route('orderReceive') }}" style="margin:0px;display:inline">
                                             @csrf
                                                <button type="submit" class="btn btn-primary">
                                                    Receive
                                                </button>
                                                <input name="orderId" value="{{$order->id}}" hidden="hidden">
                                            </form>
                                            
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
</div>
@endsection