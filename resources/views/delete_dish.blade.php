@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Delete dish</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dishPost_delete') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="dishname" class="col-md-4 col-form-label text-md-right">Dishname</label>

                            <div class="col-md-6">
                                <select id="dishName" type="text" class="form-control " name="dishName"  required autofocus>
                                    @foreach($dishName as $dish)
                                        <option value="{{$dish['dishName']}}">{{$dish['dishName']}}</option>
                                    @endforeach
                                </select>
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
@endsection
