<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
        >
    <title>Edit Course</title>
</head>
<body>
    <form action="{{ route('course.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        d<h1>Edit Selected Course</h1>
        <div class="grid">
        
            <label>
                Department
                <select name="department_id">
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $course->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->title }}
                        </option>
                    @endforeach
                </select>
            </label>
    
            <label>
                Code
                <input type="text" name="code" value="{{ old('code', $course->code)  }}">
            </label>
    
            <label>
                Acronym
                <input type="text" name="acronym" value="{{ old('acronym', $course->acronym)  }}">
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
                <input type="year" name="year_granted" value="{{ old('year_granted', $course->year_granted) }}">
            </label>
    
            <label>
                Years
                <input type="number" name="years" value="{{ old('years', $course->years) }}">
            </label>
    
            <label>
                Slots
                <input type="number" name="slots"value="{{ old('slots', $course->slots) }}">
            </label>
        </div>
    
        <button type="submit">Edit Course</button>
    </form>
</body>
</html>



