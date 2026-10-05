<!DOCTYPE html>
<html>
<head>
    <title>Create Course</title>
</head>
<body>

<h1>Create Course</h1>

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

<form action="{{ route('courses.store') }}" method="POST">

    @csrf

    <div>
        <label for="name">Course Name:</label><br>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
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
        >{{ old('description') }}</textarea>
    </div>

    <br>

    <div>
        <label for="duration">Duration (weeks):</label><br>
        <input
            type="number"
            id="duration"
            name="duration"
            value="{{ old('duration') }}"
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
            value="{{ old('fee') }}"
            step="0.01"
            min="0"
        >
    </div>

    <br>

    <div>
        <label for="difficulty">Difficulty:</label><br>

        <select id="difficulty" name="difficulty">

            <option value="">Select Difficulty</option>

            <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>
                Easy
            </option>

            <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>
                Medium
            </option>

            <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>
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
                {{ old('is_active', true) ? 'checked' : '' }}
            >
            Course is Active
        </label>
    </div>

    <br>

    <button type="submit">Create Course</button>

</form>

<br>

<a href="{{ route('courses.index') }}">Back to Courses</a>

</body>
</html>