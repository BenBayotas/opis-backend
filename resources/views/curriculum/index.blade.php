<x-layout>
    <x-slot:title>
        Curriculum Management
    </x-slot:title>


    <!--separate because it's not part of the form, it just iflters the course dropdown-->
    <label>
    Course:
        <select name="course" required>
        @foreach ($courses as $course)
            <option value="{{ $course->id }}">{{ $course->description }}</option>
        @endforeach
        </select>
    </label>

    <!--this feels weird, I want to do a get request so it should probably-->
    <!--be an anchor, dynamically change form action-->
    <form action="{{ route('curriculum.show')}}" method="GET">
        <label>
        <!--NOTE: lists all curriculum years, will probably want to use-->
        <!--htmx to auto generate this-->
        Curriculum:
            <select name="curriculum" required>
                <option value="" disabled selected>Select curriculum</option>
            @foreach ($curriculums as $curriculum)
                <option value="{{ $curriculum->id }}">{{ $curriculum->year_implemented }}</option>
            @endforeach
            </select>
        </label>

        <input type="submit" value="view curriculum">
    </form>

    <a role="button" href="{{ route('curriculum.create') }}">Create a new Curriculum</a>
</x-layout>
