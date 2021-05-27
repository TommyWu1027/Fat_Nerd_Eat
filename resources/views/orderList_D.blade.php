@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">orderReceive</div>

                <div class="card-body">
                   

                            <div class="form-group row" style="margin-left: auto;margin-right: auto;">

                            
                                <table class="table"  width="100%">
                                        <thead>
                                            <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">StoreImage</th>
                                            <th scope="col">Store</th>
                                            <th scope="col">destination</th>                        
                                            <th scope="col">Receive</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($orderList as $order)
                                            @if ( $order->status=="Finding a deliver" )
                                            <tr>
                                            <td>{{$order->id}}</td>
                                            <th scope="row"><img src="{{ URL::asset('storage/'.$order->store.'/logo.jpg') }}" id="img"/></th>
                                            <th scope="row">{{(DB::table('stores')->where('id', (int)($order->store ))->get('name'))[0]->name}}</th>
                                            <td>{{$order->destination}}</td>
                                            
                                            <td>
                                            <form method="POST" action="{{ route('orderReceive') }}">
                                             @csrf
                                                <input name="orderId" value="{{$order->id}}" hidden="hidden">
                                                <button type="submit" class="btn btn-primary">
                                                    Receive
                                                </button>
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