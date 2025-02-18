<x-layout>
    <x-slot:title>
        Curriculum Management
    </x-slot:title>

    <form action="{{ route('curriculum.index')}}" method="GET">
    <label>
    Course:
        <select name="curriculum_year" required>
        @foreach ($courses as $course)
            <option>{{ $course->description }}</option>
        @endforeach
        </select>
    </label>

    <label>
    NOTE: lists all curriculum years, will probably want to use
    htmx to auto generate this
    Curriculum Year:
        <select name="curriculum_year" required>
        @foreach ($curriculums as $curriculum)
            <option>{{ $curriculum->curriculum_year }}</option>
        @endforeach
        </select>
    </label>

    <input type="submit" value="view curriculum">
    </form>
</x-layout>
