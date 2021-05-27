@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Order</div>

                <div class="card-body">
                   

                        <div class="form-group row" style="margin-left: auto;margin-right: auto;">

                        
                            <table class="table"  width="100%">
                                    <thead>
                                        <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Store</th>      
                                        <th scope="col">Status</th>
                                        <th scope="col">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($myOrderList as $myOrder)
                                         
                                        <tr>
                                        <th scope="row">{{$myOrder->id}}</th>
                                        <td>{{(DB::table('stores')->where('id', (int)($myOrder->store ))->get('name'))[0]->name}}</td>
                                        <td>{{$myOrder->status}}</td>
                                        <td>
                                        <input type ="button"  class="btn btn-primary" onclick="javascript:location.href='http://127.0.0.1:8000/orderDetail/{{$myOrder->id}}'" value="Detail"></input>
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
</div>
@endsection
