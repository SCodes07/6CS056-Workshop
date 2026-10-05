<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
</head>
<body>

<h1>Courses</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<a href="{{ route('courses.create') }}">Add New Course</a>

<br><br>

@if($courses->count() > 0)

    <table border="1" cellpadding="10">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Duration</th>
                <th>Fee</th>
                <th>Difficulty</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @foreach($courses as $course)

                <tr>
                    <td>{{ $course->id }}</td>

                    <td>{{ $course->name }}</td>

                    <td>{{ $course->duration }} weeks</td>

                    <td>{{ $course->fee }}</td>

                    <td>{{ $course->difficulty }}</td>

                    <td>
                        @if($course->is_active)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('courses.show', $course->id) }}">
                            View
                        </a>

                        |

                        <a href="{{ route('courses.edit', $course->id) }}">
                            Edit
                        </a>

                        |

                        <form
                            action="{{ route('courses.destroy', $course->id) }}"
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

    <p>No courses found.</p>

@endif

<br>

<a href="{{ route('students.index') }}">Go to Students</a>

</body>
</html>