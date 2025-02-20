<form id="course-form" action="{{ route('course.update', $course->id) }}" method="POST">
    @csrf
    @method('PUT')
    <h2>Edit Course #{{ $course->id }}</h2>

    <div class="grid">
        <label>
            Department
            <select name="department_id">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id', $course->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->title }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Code
            <input type="text" name="code" value="{{ $course->code }}">
        </label>

        <label>
            Acronym
            <input type="text" name="acronym" value="{{ $course->acronym }}">
        </label>
    </div>

    <div class="grid">
        <label>
            Description
            <input type="text" name="description" value="{{ $course->description }}">
        </label>

        <label>
            Major
            <input type="text" name="major" value="{{ $course->major }}">
        </label>

        <label>
            Authority No.
            <input type="text" name="authority_no" value="{{ $course->authority_no }}">
        </label>

        <label>
            Accreditation Id
            <input type="text" name="accreditation_id" value="{{ $course->accreditation_id }}">
        </label>
    </div>

    <div class="grid">
        <label>
            Year Granted
            <input type="text" name="year_granted" value="{{ $course->year_granted }}">
        </label>

        <label>
            Years
            <input type="number" name="years" value="{{ $course->years }}">
        </label>

        <label>
            Slots
            <input type="number" name="slots" value="{{ $course->slots }}">
        </label>
    </div>

    <button type="submit">Update Course</button>
</form>
