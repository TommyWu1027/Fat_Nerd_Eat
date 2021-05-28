@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('orderPost_add') }}">
                        @csrf

                        <div class="form-group row" style="margin-left: auto;margin-right: auto;">

                        
                            <table class="table"  width="100%">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($menu as $dish)
                                         
                                        <tr>
                                        <th scope="row"><img src="{{ URL::asset('storage/'.$storeid.'/'.$dish["dishName"].'.jpg') }}" id="img"/></th>
                                        <td>{{$dish['dishName']}}</td>
                                        <td>{{$dish['dishPrice']}}</td>
                                        <td>
                                            <input id="quantity" name="{{$dish['dishName']}}" type="number" min="0" style="width: 40px;" value="0">
                                        </td>    
                                        </tr>
                                        
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    
                        <input id="id" type="text" class="form-control " name="id"  hidden="hidden" value="{{ Auth::user()->id }}">
                        <input id="storeid" type="text" class="form-control " name="storeid"  hidden="hidden" value="{{ $storeid }}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
