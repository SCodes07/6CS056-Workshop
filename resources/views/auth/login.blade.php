<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<x-navbar />

<h1>Login</h1>

@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('login') }}" method="POST">

    @csrf

    <div>
        <label for="email">Email:</label><br>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
    </div>

    <br>

    <div>
        <label for="password">Password:</label><br>
        <input
            type="password"
            id="password"
            name="password"
            required
        >
    </div>

    <br>

    <button type="submit">Login</button>

</form>

<br>

<a href="{{ route('register') }}">Don't have an account? Register</a>

</body>
</html>
