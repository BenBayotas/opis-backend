<x-layout>
    <x-slot:title>
        Edit {{ $curriculum->year_implemented }}
    </x-slot:title>

    <h1>Edit Curriculum</h1>
    <form action="{{ route('curriculum.update', $curriculum->id) }}" method="POST">
        @csrf
        @method("PUT")

        <label>
            Year
            <!--TODO: change this to year_implemented once thing is merged -->
            <input name="year_implemented" type="number" value="{{ old('year_implemented') ? old('year_implemented') : $curriculum->year_implemented }}" required>
        </label>

        <label>
        Course:
            <select name="course" required>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}" {{ $curriculum->course_id == $course->id ? 'selected' : '' }}>{{ $course->description }}</option>
            @endforeach
            </select>
        </label>

        <input type="submit" value="Update">
    </form>

</x-layout>
