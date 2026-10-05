<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
</head>
<body>
    <h1>Add New Student</h1>

    {{-- Display validation errors --}}
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

    {{-- Student registration form --}}
    <form action="/student" method="POST">
        @csrf

        <label>Name:</label>
        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
        >
        <br><br>

        <label>Email:</label>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
        <br><br>

        <label>Phone:</label>
        <input
            type="text"
            name="phone"
            value="{{ old('phone') }}"
            required
        >
        <br><br>

        <label>Address:</label>
        <textarea name="address">{{ old('address') }}</textarea>
        <br><br>

        <label>Date of Birth:</label>
        <input
            type="date"
            name="date_of_birth"
            value="{{ old('date_of_birth') }}"
        >
        <br><br>

        <button type="submit">Save Student</button>
    </form>

    <br>

    <a href="/students">Back to Student List</a>
</body>
</html>