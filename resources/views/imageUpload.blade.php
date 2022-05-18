<!DOCTYPE html>
<html>
<head>
    <title>How to Resize and Compress Image in Laravel 9 - Mywebtuts.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container border mt-5">

    <h3 class="text-center mt-3">How to Resize and Compress Image in Laravel 9 - Mywebtuts.com</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger mt-5">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="row">
            <div class="col-md-4">
                <strong>Original Image:</strong>
                <br/>
                <img src="/images/{{ Session::get('imageName') }}" width="300px" />
            </div>
            <div class="col-md-4">
                <strong>Thumbnail Image:</strong>
                <br/>
                <img src="/thumbnail/{{ Session::get('imageName') }}" />
            </div>
        </div>
    @endif

    <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <br/>
                <label class="mb-1"><strong>Select Image:</strong></label>
                <input type="file" name="photo" class="image form-control">
            </div>
            <div class="col-md-12 mb-3">
                <br/>
                <button type="submit" class="btn btn-success">Upload Image</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
