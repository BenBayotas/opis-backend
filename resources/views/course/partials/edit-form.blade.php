<form action="{{ route('course.update', $course->id) }}" method="POST">
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
            <input type="text" name="code" value="{{ old('code', $course->code) }}">
        </label>

        <label>
            Acronym
            <input type="text" name="acronym" value="{{ old('acronym', $course->acronym) }}">
        </label>
    </div>

    <div class="grid">
        <label>
            Description
            <input type="text" name="description" value="{{ old('description', $course->description) }}">
        </label>

        <label>
            Major
            <input type="text" name="major" value="{{ old('major', $course->major) }}">
        </label>

        <label>
            Authority No.
            <input type="text" name="authority_no" value="{{ old('authority_no', $course->authority_no) }}">
        </label>

        <label>
            Accreditation Id
            <input type="text" name="accreditation_id" value="{{ old('accreditation_id', $course->accreditation_id) }}">
        </label>
    </div>

    <div class="grid">
        <label>
            Year Granted
            <input type="text" name="year_granted" value="{{ old('year_granted', $course->year_granted) }}">
        </label>

        <label>
            Years
            <input type="number" name="years" value="{{ old('years', $course->years) }}">
        </label>

        <label>
            Slots
            <input type="number" name="slots" value="{{ old('slots', $course->slots) }}">
        </label>
    </div>

    <button type="submit">Update Course</button>
</form>