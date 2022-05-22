<!DOCTYPE html>
<html lang="ar">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{--    <meta charset="utf-8"/>--}}
    <style>
        * {
            background: deepskyblue;
            font-family: DejaVu Sans, sans-serif;
            /*font-family: Arial , arabic;*/

            direction: rtl; text-align: right;
        } </style>


    <title></title>
</head>
<body>
<table class="table table-bordered">

    <thead>
        <tr>
            <td scope="col">{{ 'ID'}}  </td>
            <td scope="col">{{'Name'}}    </td>
            <td scope="col">{{'Email'}}   </td>
            <td scope="col">{{'Password'}}   </td>
        </tr>
        </thead>
      
        <tbody>

          @foreach($user as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->password}}</td>

            </tr>
          @endforeach
        </tbody>

</table>
</body>
</html>
