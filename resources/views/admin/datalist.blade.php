<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>
    @include('layout.navbar')
    <h1>Data List</h1>
    <div class="container col-md-6">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SL.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Join Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $key => $list)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ ucfirst($list->name) }}</td>
                    <td>{{ $list->dept->name }}</td>
                    <td>{{ $list->email }}</td>
                    <td>{{ $list->mobile }}</td>
                    <td>{{ $list->created_at->format('d/m/Y h:i a') }}</td>
                    <td>
                        <a type="button" class="btn btn-info btn-sm"  data-bs-toggle="modal" data-bs-target="#edit" data-id="{{$list->id}}" data-name="{{$list->name}}" data-mobile="{{$list->mobile}}" data-email="{{$list->email}}">Editt</a>&nbsp;

                        <a href="{{ url('/data/edit/'.$list->id) }}" class="btn btn-info btn-sm"  >Edit</a>&nbsp;
                        <a href="{{ url('/data/delete/'.$list->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you want to delete?')">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <label class="pull-left">
                Showing {{ $lists->firstItem() }} to {{ $lists->lastItem() }} of {{ $lists->total() }} entries
            </span>
            <label class="pull-right">
                {{ $lists->links() }}
            </label>
          </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('/post/update')}}" method="post">
                @method('patch')
                @csrf
            <div class="modal-body">
                <input type="hidden" name="id" id="data_id" value="">
                <input type="text" name="name" id="data_name" value="" placeholder="Name" required><br><br>
                <input type="text" name="mobile" id="data_mobile" value="" placeholder="Contact No" required><br><br>
                <input type="email" name="email" id="data_email" value="" placeholder="Email" required><br><br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
          </div>
        </div>
    </div>

    <script>
        $("#edit").on('shown.bs.modal', function (event) {
         var button = $(event.relatedTarget);
         var data_id = button.data('id');
         var data_name = button.data('name');
         var data_mobile = button.data('mobile');
         var data_email = button.data('email');
         var modal = $(this);
         modal.find('.modal-body #data_id').val(data_id);
         modal.find('.modal-body #data_name').val(data_name);
         modal.find('.modal-body #data_mobile').val(data_mobile);
         modal.find('.modal-body #data_email').val(data_email);
        });
    </script>
</body>
</html>