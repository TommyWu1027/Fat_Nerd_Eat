@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">orderReceive</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('orderReceive') }}">
                            @csrf

                            <div class="form-group row" style="margin-left: auto;margin-right: auto;">

                            
                                <table class="table"  width="100%">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">destination</th>
                                            <th scope="col">content</th>
                                            <th scope="col">Receive</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($orderList as $order)
                                            
                                            <tr>
                                            <th scope="row"></th>
                                            <td>{{$order->destination}}</td>
                                            <td>{{$order->content}}</td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">
                                                    Receive
                                                </button>
                                            </td>    
                                            </tr>
                                            
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        
                            <input id="id" type="text" class="form-control " name="id"  hidden="hidden" value="{{ Auth::user()->id }}">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection