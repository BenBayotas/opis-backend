<x-layout>
    <x-slot:title>
        Create Curriculum
    </x-slot:title>

    <form action="{{ route('curriculum.store') }}" method="POST">
    @csrf

    <label>
        Year
        <input name="year" type="number" required>
    </label>

    <label>
    Course:
        <select name="course" required>
        @foreach ($courses as $course)
            <option value="{{ $course->id }}">{{ $course->description }}</option>
        @endforeach
        </select>
    </label>

    <!--theoretically should make a validation check here-->
    <!--if the thing already exists or not-->
    <input type="submit" value="Create">
    </form>
</x-layout>
