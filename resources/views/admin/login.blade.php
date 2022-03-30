<h1 style="text-align: center">Login</h1><hr>

@if(Session('success'))
    <h4>{{Session('success')}} {{Session::forget('success')}}</h4>  
@elseif(Session('error'))
    <h4>{{Session('error')}} {{Session::forget('error')}}</h4> 
@endif

<form action="{{ url('login/submit') }}" method="post">
    @csrf
    <input type="email" name="email" placeholder="Enter Email" required><br><br>
    <input type="password" name="password" placeholder="Enter Password" required><br><br>
    <button type="submit">Login</button>
</form>