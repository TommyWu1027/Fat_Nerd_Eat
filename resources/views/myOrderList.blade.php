@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Order</div>

                <div class="card-body">
                   

                        <div class="form-group row" style="margin-left: auto;margin-right: auto;">

                        
                            <table class="rwd-table">
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
                                        <td data-th="ID">{{$myOrder->id}}</th>
                                        <td data-th="Store">{{(DB::table('stores')->where('id', (int)($myOrder->store ))->get('name'))[0]->name}}</td>
                                        <td data-th="Status">{{$myOrder->status}}</td>
                                        <td data-th="action">
                                        <input type ="button"  class="btn btn-primary" onclick="javascript:location.href='./orderDetail/{{$myOrder->id}}'" value="Detail"></input>
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
