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

                        <div class="form-group row">

                            <div class="col-md-6">
                                    @foreach($menu as $dish)
                                        {{$dish['dishName']}} : {{$dish['dishPrice']}}
                                        <input id="quantity" name="{{$dish['dishName']}}" type="number">
                                        <br>
                                    @endforeach
    
                            </div>
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
