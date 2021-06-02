@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('orderUpdatePost') }}">
                        @csrf

                        <div class="form-group row" style="margin-left: auto;margin-right: auto;">

                        
                            <table class="rwd-table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @for ($i = 0; $i < count($menu); $i++)
                                         
                                        <tr>
                                        <td data-th="Image" ><img src="{{ URL::asset('storage/'.$storeid.'/'.$menu[$i]["dishName"].'.jpg') }}" id="img"/></td>
                                        <td data-th="Name" >{{ $menu[$i]['dishName'] }}</td>
                                        <td data-th="Price" >{{ $menu[$i]['dishPrice'] }}</td>
                                        <td data-th="Quantity" >
                                            <input id="{{$menu[$i]['dishName']}}" name="{{$menu[$i]['dishName']}}" type="number" min="0" style="width: 40px;" value='{{$orderDish[$i]["quantity"]}}'>
                                        </td>    
                                        </tr>
                                        
                                    @endfor
                                    </tbody>
                                </table>
                        </div>
                    
                        <input id="id" type="text" class="form-control " name="id"  hidden="hidden" value="{{ Auth::user()->id }}">
                        <input id="storeid" type="text" class="form-control " name="storeid"  hidden="hidden" value="{{ $storeid }}">
                        <input id="orderId" type="text" class="form-control " name="orderId"  hidden="hidden" value="{{ $orderid }}">
                        <div class="form-group row">
                            <label for="destination" class="col-md-4 col-form-label text-md-right">Destination</label>

                            <div class="col-md-6">
                                <input id="destination" type="text" class="form-control" name="destination" required value="{{$orderDetail->destination}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-md-4 col-form-label text-md-right">Total Price</label>

                            <div class="col-md-6">
                                <input id="total" type="text" class="form-control" name="total" required value="{{$orderDetail->bill}}" readonly="readonly">
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                You have to order something.
                            </ul>
                        </div>
                    @endif
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


