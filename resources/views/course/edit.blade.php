<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
</head>
<body>

<h1>Edit Course</h1>

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

<form action="{{ route('courses.update', $course->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div>
        <label for="name">Course Name:</label><br>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $course->name) }}"
        >
    </div>

    <br>

    <div>
        <label for="description">Description:</label><br>

        <textarea
            id="description"
            name="description"
            rows="5"
            cols="40"
        >{{ old('description', $course->description) }}</textarea>
    </div>

    <br>

    <div>
        <label for="duration">Duration (weeks):</label><br>

        <input
            type="number"
            id="duration"
            name="duration"
            value="{{ old('duration', $course->duration) }}"
            min="1"
        >
    </div>

    <br>

    <div>
        <label for="fee">Fee:</label><br>

        <input
            type="number"
            id="fee"
            name="fee"
            value="{{ old('fee', $course->fee) }}"
            step="0.01"
            min="0"
        >
    </div>

    <br>

    <div>
        <label for="difficulty">Difficulty:</label><br>

        <select id="difficulty" name="difficulty">

            <option value="Easy"
                {{ old('difficulty', $course->difficulty) == 'Easy' ? 'selected' : '' }}>
                Easy
            </option>

            <option value="Medium"
                {{ old('difficulty', $course->difficulty) == 'Medium' ? 'selected' : '' }}>
                Medium
            </option>

            <option value="Hard"
                {{ old('difficulty', $course->difficulty) == 'Hard' ? 'selected' : '' }}>
                Hard
            </option>

        </select>
    </div>

    <br>

    <div>
        <label>
            <input
                type="checkbox"
                name="is_active"
                value="1"
                {{ old('is_active', $course->is_active) ? 'checked' : '' }}
            >

            Course is Active
        </label>
    </div>

    <br>

    <button type="submit">Update Course</button>

</form>

<br>

<a href="{{ route('courses.show', $course->id) }}">
    Back to Course Details
</a>

<br><br>

<a href="{{ route('courses.index') }}">
    Back to Courses
</a>

</body>
</html>