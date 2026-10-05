<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>

<body>

    <h1>Edit Student</h1>

    @if($errors->any())

        <div>

            <h3>Please fix the following errors:</h3>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('students.update', $student->id) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        <!-- Name -->

        <div>

            <label for="name">
                Name:
            </label>

            <br>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $student->name) }}"
            >

        </div>

        <br>


        <!-- Email -->

        <div>

            <label for="email">
                Email:
            </label>

            <br>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $student->email) }}"
            >

        </div>

        <br>


        <!-- Phone -->

        <div>

            <label for="phone">
                Phone:
            </label>

            <br>

            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $student->phone) }}"
            >

        </div>

        <br>


        <!-- Address -->

        <div>

            <label for="address">
                Address:
            </label>

            <br>

            <textarea
                id="address"
                name="address"
            >{{ old('address', $student->address) }}</textarea>

        </div>

        <br>


        <!-- Date of Birth -->

        <div>

            <label for="date_of_birth">
                Date of Birth:
            </label>

            <br>

            <input
                type="date"
                id="date_of_birth"
                name="date_of_birth"
                value="{{ old('date_of_birth', $student->date_of_birth) }}"
            >

        </div>

        <br>


        <!-- Update Button -->

        <button type="submit">
            Update Student
        </button>

    </form>

    <br>

    <a href="{{ route('students.show', $student->id) }}">
        Back to Student Details
    </a>

    <br><br>

    <a href="{{ route('students.index') }}">
        Back to Students
    </a>

</body>
</html>