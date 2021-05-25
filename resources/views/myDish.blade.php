@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    

                        <div class="form-group row">

                            <div class="col-md-6" style="margin-left: auto;margin-right: auto;">
                                <table class="table"  width="100%">
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
                                        <th scope="row"></th>
                                        <td>{{$dish['dishName']}}</td>
                                        <td>{{$dish['dishPrice']}}</td>
                                        <td>
                                            <button type="submit" class="btn btn-success" onclick="location.href='{{ route('dish_update') }}'" >Update</button>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-danger" onclick="location.href='{{ route('dish_delete') }}'" >Delete</button>
                                        </td>
                                        </tr>
                                        
                                    @endforeach
                                    </tbody>
                                </table>
    
                            </div>
                        </div>
                        

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
