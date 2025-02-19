<x-layout>
    <x-slot:title>
        Create Curriculum
    </x-slot:title>

    <h1>Create Curriculum</h1>

    <form action="{{ route('curriculum.store') }}" method="POST">
        @csrf
        <label>
            Year:
            <input type="number" name="year" required>
        </label>
        <label>
            Course:
            <select name="course" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->description }}</option>
                @endforeach
            </select>
        </label>
        <button type="submit">Create Curriculum</button>
    </form>
</x-layout>
