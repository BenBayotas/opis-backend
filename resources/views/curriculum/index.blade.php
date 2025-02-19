<x-layout>
    <x-slot:title>
        Curriculum Management
    </x-slot:title>

    <!--this feels weird, I want to do a get request so it should probably-->
    <!--be an anchor, dynamically change form action-->
    <form action="{{ route('curriculum.show')}}" method="GET">

    <!--I probably don't even need to show courses here, the only thing I really-->
    <!--care about is curriculum since curriculum has a foreign key to course anyway-->
    <!--this is just here since we would want to be able to filter by course at some point-->
    <label>
    Course:
        <select name="course" required>
        @foreach ($courses as $course)
            <option value="{{ $course->id }}">{{ $course->description }}</option>
        @endforeach
        </select>
    </label>

    <label>
    NOTE: lists all curriculum years, will probably want to use
    htmx to auto generate this
    Curriculum:
        <select name="curriculum" required>
        @foreach ($curriculums as $curriculum)
            <option value="{{ $curriculum->id }}">{{ $curriculum->curriculum_year }}</option>
        @endforeach
        </select>
    </label>

    <input type="submit" value="view curriculum">
    </form>
</x-layout>
