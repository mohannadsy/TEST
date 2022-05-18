
<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>




<table>
    <thead>
    <tr>
       
       
        <td scope="col">{{'Name'}}      | </td>
        <td scope="col">{{'Password'}}   </td>
        <td scope="col">{{'Email'}}   </td>
        <td scope="col">{{'Photo'}}   </td>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
   
        <td>{{$user-> name }}</td>
        <td>{{$user-> email }}</td>
        <td>{{$user-> password }}</td>
        <td>{{$user-> photo }}</td>


    </tr>
    @endforeach
    </tbody>

</table>
</body>
</html>

