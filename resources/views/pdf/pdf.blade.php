<!DOCTYPE html>
<html lang="ar">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{--    <meta charset="utf-8"/>--}}
    {{--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>--}}
    <style>
        * {
            background: deepskyblue;
            font-family: DejaVu Sans, sans-serif;
            /*font-family: Arial , arabic;*/
            /*direction: rtl*/
            direction: rtl; text-align: right;
        } </style>


    <title></title>
</head>
<body>
<table class="table table-bordered">
    <tr>
        <td>
            {{$user->id}}

        </td>
        <td>
            {{$user->name}}
        </td>
        <td>
         
            {{$user->password}}
        </td>
        <td>
            {{$user->email}}
        </td>
    </tr>

</table>
</body>
</html>
