<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>data</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>
    @include('layout.navbar')
    <h1>Data Edit</h1>
    @if(Session('success'))
        <h4>{{Session('success')}} {{Session::forget('success')}}</h4>    
    @endif
    <div class="container col-md-6">
        <form action="{{url('/post/update')}}" method="post">
            @method('patch')
            @csrf
            <input type="hidden" name="id" value="{{ $edit->id }}">
            <input type="text" name="name" value="{{ $edit->name }}" placeholder="Name" required><br><br>
            <input type="text" name="mobile" value="{{ $edit->mobile }}" placeholder="Contact No" required><br><br>
            <input type="email" name="email" value="{{ $edit->email }}" placeholder="Email" required><br><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>