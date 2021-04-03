@extends('frontend.index')
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title"> moyasar </h3>
                <div class="form-group">
                    <input type="text" name="id" value="{{old('id')}}" readonly/>
                </div>
                <div class="form-group">
                    <input type="text" name="status" value="{{old('status')}}" readonly/>
                </div>
                <div class="form-group">
                    <input type="text" name="amount" value="{{old('amount')}}" readonly/>
                </div>
                <div class="form-group">
                    <input type="text" name="id" value="{{old('message')}}" readonly/>
                </div>
            </div>
        </div>
    </div>
@endsection
