@extends('pdf/master')
@section('content')
    <form method="post" action="{{url('submitForm')}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="full_name_id" class="control-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="name">
        </div>

        <div class="form-group">
            <label for="street1_id" class="control-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="email">
        </div>

        <div class="form-group">
            <label for="city_id" class="control-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="password">
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary"> send </button>
        </div>

    </form>
@endsection
