<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<x-navbar />

<h1>Register</h1>

@if($errors->any())
    <div>
        <h3>Please fix the following errors:</h3>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register') }}" method="POST">

    @csrf

    <div>
        <label for="name">Name:</label><br>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >
    </div>

    <br>

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

    <div>
        <label for="password_confirmation">Confirm Password:</label><br>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            required
        >
    </div>

    <br>

    <button type="submit">Register</button>

</form>

<br>

<a href="{{ route('login') }}">Already have an account? Login</a>

</body>
</html>
