@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add dish</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dishPost_add') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="dishname" class="col-md-4 col-form-label text-md-right">Dishname</label>

                            <div class="col-md-6">
                                <input id="dishname" type="text" class="form-control " name="dishName"  required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dishprice" class="col-md-4 col-form-label text-md-right">Dishprice</label>

                            <div class="col-md-6">
                                <input id="dishprice" type="text" class="form-control " name="dishPrice"  required>

                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

                            <div class="col-md-6">
                            <input accept="image/*, image/heic, image/heif" type="file" class="form-control-file" id="image" name="image">
                            </div>
                        </div>
                        
                        
                            <input id="id" type="text" class="form-control " name="id"  hidden="hidden" value="{{ Auth::user()->id }}">

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
