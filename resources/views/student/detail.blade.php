<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
</head>

<body>

    <h1>Student Details</h1>

    @if(session('success'))
        <p>
            {{ session('success') }}
        </p>
    @endif

    <p>
        <strong>ID:</strong>
        {{ $student->id }}
    </p>

    <p>
        <strong>Name:</strong>
        {{ $student->name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $student->email }}
    </p>

    <p>
        <strong>Phone:</strong>
        {{ $student->phone }}
    </p>

    <p>
        <strong>Address:</strong>
        {{ $student->address }}
    </p>

    <p>
        <strong>Date of Birth:</strong>
        {{ $student->date_of_birth }}
    </p>

    <br>

    <a href="{{ route('students.edit', $student->id) }}">
        Edit Student
    </a>

    <br><br>

    <form
        action="{{ route('students.destroy', $student->id) }}"
        method="POST"
    >

        @csrf
        @method('DELETE')

        <button type="submit">
            Delete Student
        </button>

    </form>

    <br>

    <a href="{{ route('students.index') }}">
        Back to Students
    </a>

</body>
</html>