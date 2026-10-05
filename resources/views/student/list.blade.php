<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>

<body>

    <h1>Students</h1>


    @if(session('success'))

        <p>
            {{ session('success') }}
        </p>

    @endif


    <a href="{{ route('students.create') }}">
        Add New Student
    </a>

    <br><br>


    @if($students->count() > 0)

        <table border="1" cellpadding="10">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>

                @foreach($students as $student)

                    <tr>

                        <td>
                            {{ $student->id }}
                        </td>

                        <td>
                            {{ $student->name }}
                        </td>

                        <td>
                            {{ $student->email }}
                        </td>

                        <td>
                            {{ $student->phone }}
                        </td>

                        <td>

                            <a href="{{ route('students.show', $student->id) }}">
                                View
                            </a>

                            |

                            <a href="{{ route('students.edit', $student->id) }}">
                                Edit
                            </a>

                            |

                            <form
                                action="{{ route('students.destroy', $student->id) }}"
                                method="POST"
                                style="display:inline;"
                            >

                                @csrf

                                @method('DELETE')

                                <button type="submit">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <p>
            No students found.
        </p>

    @endif

</body>
</html>