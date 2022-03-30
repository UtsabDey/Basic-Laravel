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
        <form action="{{url('/post/submit')}}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{old('name')}}"  required>
            @error('name'){{ $message }} @enderror 
            <br><br>
            <input type="text" name="mobile" placeholder="Contact No" pattern="[0]{1}[1]{1}[0-9]{9}" title="Enter 11 digits mobile number" value="{{old('mobile')}}" required>@error('mobile'){{ $message }} @enderror<br><br>

            <select name="dept_id" required>
                <option value="">Select Dept</option> 
                @foreach($depts as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option> 
                @endforeach   
            <select><br><br>
            <input type="text" name="uname" placeholder="Username" value="{{old('uname')}}" required>@error('uname'){{ $message }} @enderror<br><br>
            <input type="email" name="email" placeholder="Email" value="{{old('email')}}" required>@error('email'){{ $message }} @enderror<br><br>
            <input type="password" name="pass" placeholder="Password" maxlength="20" value="{{old('pass')}}" required>@error('pass'){{ $message }} @enderror<br><br>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>
