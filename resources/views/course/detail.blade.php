<!DOCTYPE html>
<html>
<head>
    <title>Course Details</title>
</head>
<body>

<h1>Course Details</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<p>
    <strong>ID:</strong>
    {{ $course->id }}
</p>

<p>
    <strong>Name:</strong>
    {{ $course->name }}
</p>

<p>
    <strong>Description:</strong>
    {{ $course->description }}
</p>

<p>
    <strong>Duration:</strong>
    {{ $course->duration }} weeks
</p>

<p>
    <strong>Fee:</strong>
    {{ $course->fee }}
</p>

<p>
    <strong>Difficulty:</strong>
    {{ $course->difficulty }}
</p>

<p>
    <strong>Status:</strong>

    @if($course->is_active)
        Active
    @else
        Inactive
    @endif
</p>

<br>

<a href="{{ route('courses.edit', $course->id) }}">
    Edit Course
</a>

<br><br>

<form
    action="{{ route('courses.destroy', $course->id) }}"
    method="POST"
>

    @csrf
    @method('DELETE')

    <button type="submit">
        Delete Course
    </button>

</form>

<br>

<a href="{{ route('courses.index') }}">
    Back to Courses
</a>

</body>
</html>