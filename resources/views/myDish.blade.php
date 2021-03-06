@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dish</div>

                <div class="card-body">
                    

                        <div class="form-group row">

                            <div class="col-md-6" >
                            @if ($menu!=null)
                                <table class="rwd-table" >
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Update</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    
                                        @foreach($menu as $dish)
                                            
                                            <tr>
                                                <td data-th="Image"><img src="{{ URL::asset('storage/'.$storeid.'/'.$dish["dishName"].'.jpg') }}" id="img"/></td>
                                                <td data-th="Name">{{$dish['dishName']}}</td>
                                                <td data-th="Price">{{$dish['dishPrice']}}</td>
                                                <td data-th="Update">
                                                    <button type="submit" class="btn btn-success" onclick="location.href='{{ route('dish_update',$dish['dishName']) }}'" >Update</button>
                                                </td>
                                                <td data-th="Delete">
                                                    <form method="POST" action="{{ route('dishPost_delete') }}" style="margin:0px;display:inline">
                                                        @csrf
                                                        <input id="dishName" type="text" class="form-control " name="dishName"  hidden="hidden" value="{{$dish['dishName']}}" >
                                                        <button type="submit" class="btn btn-danger">Delete</button>

                                                    </form>
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                   
                                    </tbody>
                                </table>
                            @endif
                            </div>
                        </div>
                        
                        <br>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="location.href='{{ route('dish_add') }}'" >
                                    add_new_Dish
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
