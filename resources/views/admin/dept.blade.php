<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Project</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        @include('layout.navbar')
        
        <h1>{{$show}}</h1>
        <h2>Current Date & Time: {{$datetime}}</h2>
        @if(Session('success'))
        <h4>{{Session('success')}} {{Session::forget('success')}}</h4>    
        @endif
        <form action="{{url('/dept/submit')}}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Enter Department Name" value="{{old('name')}}"  required>
            @error('name'){{ $message }} @enderror 
            <br><br>
            <button type="submit">Submit</button>
        </form><br>
        <div class="container col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">SL.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Total Student</th>
                        <th scope="col">Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lists as $key => $list)
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ ucfirst($list->name) }}</td>
                        <td>{{ $list->student->count() }}</td>
                        <td>{{ $list->created_at->format('d/m/Y h:i a') }}</td>
                        <td>
                            <a href="{{ url('/data/edit/'.$list->id) }}" class="btn btn-info btn-sm">Edit</a>&nbsp;
                            <a href="{{ url('/data/delete/'.$list->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you want to delete?')">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
