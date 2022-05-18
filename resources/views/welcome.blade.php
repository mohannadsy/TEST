 <!DOCTYPE html>
 <html>
 <head>
     <title>Laravel Resize Image Tutorial With Helper Trait - CodeCheef </title>
 </head>
 <body>
   
 <div class="container">
     <h1>Laravel Resize Image Tutorial With Helper Trait - CodeCheef</h1>
     @if (count($errors) > 0)
         <div class="alert alert-danger">
             <strong>Whoops!</strong> There were some problems with your input.<br><br>
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif
          
     @if ($message = Session::get('message'))
     <div class="alert alert-success alert-block">
         <button type="button" class="close" data-dismiss="alert">×</button>    
         <strong>{{ $message }}</strong>
     </div>
     @endif
          
    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="name">
        <input type="password" name="password" class="form-control" placeholder="price">
        <input type="email" name="email" class="form-control" placeholder="qty">
        <input type="file" name="image" class="image">

        <button type="submit" class="btn btn-success">Add User</button>
    </form>
</div>
  
</body>
</html>



