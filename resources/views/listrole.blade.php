<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        /* Custom styles for sidebar */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            padding-top: 50px;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575d63;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
     <div class="sidebar">
        <h4 class="text-center">Dashboard</h4>
        @can('view per')
             <a href="{{ url('listper') }}">Permission</a>
        @endcan
       
        <a href="#">Profile</a>
        <a href="{{ url('listservice') }}">Services</a>
        <a href="#">Contact</a>
        @can('view rol')
            <a href="{{ url('listrole') }}">Role</a>
        @endcan
        @can('view user')
            <a href="{{ url('listuser') }}">users</a>
        @endcan
         
         
        @if (auth()->guard('customer')->check())
            <a href="{{route('customer.logout')}}">Logout</a>
        @endif
        @if (auth()->guard('web')->check())
            <a href="{{route('merchant.logout')}}">Logout</a>
        @endif
    </div>
         

    <!-- Content -->
    <div class="content">
        @if (auth()->guard('web')->check())
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Crud</h1>
                    <a href="{{ url('addrole') }}">Add Role</a>

                </div>
            </div>

            <div class="row" style="margin:5rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->permissions->pluck('name')->implode(',')}}</td>
                          
                          
                            <td>
                                 @can('edit rol')
                                    <button type="submit" data-id="{{$item->id}}" class="btn btn-success" id="editbutton">Edit</button>

                                  @endcan
                                  @can('delete rol')
                                                                  <button type="submit" data-id="{{$item->id}}" class="btn btn-danger" id="deletebutton">Delete</button>

                                  @endcan

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        $(document).on("click", "#editbutton", function(e) {
            e.preventDefault();
            var ids = $(this).data('id');
            var url = "{{ url('roleedit') }}?ids=" + ids;
            window.location.href = url;
        });
        $(document).on("click", "#deletebutton", function(e) {
            e.preventDefault();
            var ids = $(this).data('id');
            var url = "{{ url('roldelete') }}?ids=" + ids;
            window.location.href = url;
        });
    </script>
</body>
</html>
