@extends('pdf/master')
@section('content')
    <table class="table table-striped">
        <thead>
        <th>ID</th>
        <th>Full Name</th>
        <th>Password</th>
        <th>Email</th>

        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->password}}</td>
                <td>{{$user->email}}</td>

                {{--                <td><a href="{{action([\App\Http\Controllers\UserController::class,'downloadPDF'], $user->id)}}">PDF</a></td>--}}
                <td><a href="{{url('/downloadPDF/'. $user->id)}}">PDF</a></td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
