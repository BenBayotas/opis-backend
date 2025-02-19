<x-layout>
    <x-slot:title>
        Curriculum Management
    </x-slot:title>

    <h1>Curriculum Management</h1>
    
    <a href="{{ route('curriculum.create') }}">Create a New Curriculum</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Curriculum Year</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($curriculums as $curriculum)
                <tr>
                    <td>{{ $curriculum->id }}</td>
                    <td>{{ $curriculum->curriculum_year }}</td>
                    <td>{{ $curriculum->course->description ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('curriculum.show', ['curriculum' => $curriculum->id]) }}">View</a>
                        <a href="{{ route('curriculum.edit', $curriculum->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>

