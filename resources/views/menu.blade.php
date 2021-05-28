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
                                            <input id="{{$dish['dishName']}}" name="{{$dish['dishName']}}" type="number" min="0" style="width: 40px;" value="0">
                                        </td>    
                                        </tr>
                                        
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    
                        <input id="id" type="text" class="form-control " name="id"  hidden="hidden" value="{{ Auth::user()->id }}">
                        <input id="storeid" type="text" class="form-control " name="storeid"  hidden="hidden" value="{{ $storeid }}">

                        <div class="form-group row">
                            <label for="destination" class="col-md-4 col-form-label text-md-right">Destination</label>

                            <div class="col-md-6">
                                <input id="destination" type="text" class="form-control" name="destination" required value="{{$address}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-md-4 col-form-label text-md-right">Total Price</label>

                            <div class="col-md-6">
                                <input id="total" type="text" class="form-control" name="total" required value="0" readonly="readonly">
                            </div>
                        </div>

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

<script>
    
    $(document).ready(function(){

        let dishName = [];
        let dishPrice = [];
        

        @foreach($menu as $dish)
        var {{$dish['dishName']}} = document.getElementById("{{$dish['dishName']}}");
        {{$dish['dishName']}}.addEventListener('change', (event) => {
            var totalPrice = 0;
            for(i=0;i<dishName.length;i++){
                
                totalPrice += Number(dishName[i].value) *  Number(dishPrice[i]);
               
            }
            document.getElementById("total").value=totalPrice;

        })

       dishName.push({{$dish['dishName']}});
       dishPrice.push({{$dish['dishPrice']}});
        
        @endforeach

        
    
    })

</script>

@endsection


