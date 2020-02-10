<!DOCTYPE html>
<html>

<head>
  <title>EmpowerU | Login</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="width:500px;">
        <br></br>
        <img src="{{ asset('template/images/form-img.png') }}" alt="" style="width: 500px;">
        <h3 align="">Dashboard Login</h3><br />
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label>Username</label>
            <input 
                id="username" 
                type="text" 
                class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" 
                name="username" 
                value="{{ old('username') }}" 
                required 
                autofocus
            />

            <br />
            <label>Password</label>
            <input 
                id="password" 
                type="password" 
                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                name="password" 
                required
            />

            @if ($errors->has('username') || $errors->has('password'))
                <strong style="color: #ff0000;">Invalid Username / Password</strong>
            @endif

            <br />
            <br />
            <input type="submit" name="login" class="btn btn-info" value="Login" />
        </form>
    </div>
</body>

</html>