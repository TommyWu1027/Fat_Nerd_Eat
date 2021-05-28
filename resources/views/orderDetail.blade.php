@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Detail</div>

                <div class="card-body">
                    
                

                            <table class="table"  >
                                    <thead>
                                        <tr>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Content</th>      
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <th scope="row">Order ID</th>
                                            <td>{{ $order->id }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th scope="row">Store</th>
                                            <td>{{(DB::table('stores')->where('id', (int)($order->store ))->get('name'))[0]->name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Deliver</th>
                                            <td>
                                            @if ($order->deliver != null)
                                            {{(DB::table('users')->where('id', (int)($order->deliver ))->get('name'))[0]->name}}
                                            @else
                                            Finding a deliver
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Customer</th>
                                            <td>{{(DB::table('users')->where('id', (int)($order->customer ))->get('name'))[0]->name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Destination</th>
                                            <td>{{ $order->destination }}</td>
                                        </tr>
                                        <!-- <tr>
                                            <th scope="row">Time</th>
                                            <td>{{ $order->time }}</td>
                                        </tr> -->
                                        <tr>
                                            <th scope="row">Content</th>
                                            <td>
                                                @foreach($content as $dish)
                                                {{ $dish['dishName'] }} * {{ $dish['quantity'] }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td>{{ $order->status }}</td>
                                        </tr>
                                        @if(Auth::user()->type=="Deliver")
                                        @if($order->status!="Done")    
                                        <tr>
                                            
                                            <th scope="row">Action</th>
                                            <td>
                                                <form method="POST" action="{{ route('changeStatus') }}">
                                                @csrf
                                                
                                                <input name="orderId" value="{{ $order->id }}" hidden="hidden">
                                                @if($order->status=="On the way to receive")
                                                    <button type="submit" class="btn btn-primary" >I'm already get the dish</button>    
                                                @endif

                                                @if($order->status=="On the way to customer")
                                                    <button type="submit" class="btn btn-primary" >I'm arrived</button>    
                                                @endif

                                                @if($order->status=="Arrived")
                                                    <button type="submit" class="btn btn-primary" >Finish the order</button>    
                                                @endif

                                                </form>
                                            </td>
                                            
                                        </tr>
                                        @endif
                                        @endif
                                   
                                    </tbody>
                            </table>


                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
