@extends('pdf/master')
@section('content')
    <table class="table table-striped">
        <thead>
        <th>ID</th>
        <th>Full Name</th>
        <th>Password</th>
        <th>Email</th>
        <th>Photo</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->password}}</td>
                <td>{{$user->email}}</td>
                {{-- <td>{{$user->photo}}</td> --}}



                <form enctype="multipart/form-data" >

                <td><img src="{{ asset('/storage/uploadedImages/' . $user->photo . "PNG") }}"/></td>
                <td> ECHO <img src="data:image/jpeg;base64,'.base64_encode({{$user->photo}}).'"/></td>

                </form>


                {{--                Failed Tests  <3   :( WTF      --}}
                {{-- <img src="{{  asset('/storage/uploadedImages/' .base64_encode( $user->photo )) }}"> --}}
                {{-- <img src="data:image/JPG;base64,'.base64_encode($user->photo).'"/> --}}
                {{-- <img src="/storage/uploadedImages/{{$user->photo}}.png" > --}}
                {{-- <img src="data:image/jpeg;base64,'.base64_encode($user->photo  ).'"/>;
                <img src="{{asset("/storage/uploadedImages/'.base64_encode($user->photo'" )}}"/>;
                <img src="{{url('/storage/uploadedImages/' . $user->photo )}}"/> --}}


            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
