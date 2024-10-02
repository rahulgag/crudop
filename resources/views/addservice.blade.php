<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('insert.service')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="col-md-3">

            </div>
             <div class="col-md-6">
                <label for="">Name</label>
                <input type="text" name="uname" class="form-control">
                  <label for="">Image</label>
                <input type="file" name="image"  class="form-control">
                <button type="submit" class="btn">Submit</button>
            </div>
             <div class="col-md-3">
                
            </div>
        </div>
    </form>
</body>
</html>