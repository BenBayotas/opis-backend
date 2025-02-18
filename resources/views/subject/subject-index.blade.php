<x-layout>
    <x-slot:title>
        Subject File
    </x-slot:title>

    <h1>
        Subject File
    </h1>

    <a href="{{ route('subject.create') }}">Add New Subject</a>
    <table>
        <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Subject Code</th>
                <th>Subject Title</th>
                <th>Department</th>
                <th>Credited Units</th>
                <th>LEC Hours</th>
                <th>LAB Hours</th>
                <th>Is Major</th>
                <th>Special</th>
                <th>Elective</th>
                <th>No Text Booklet</th>
                <th>Is Not WGA</th>
                <th>Tuition Units</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>
                        <a role="button" href="{{ route('subject.edit', $subject->id) }}">Edit</a>
                    </td>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->subject_code }}</td>
                    <td>{{ $subject->subject_title }}</td>
                    <td>{{ $subject->department->title ?? 'N/A' }}</td>
                    <td>{{ $subject->credited_units }}</td>
                    <td>{{ $subject->lec_hours }}</td>
                    <td>{{ $subject->lab_hours }}</td>
                    <td>{{ $subject->is_major ? 'Yes' : 'No' }}</td>
                    <td>{{ $subject->special ? 'Yes' : 'No' }}</td>
                    <td>{{ $subject->elective ? 'Yes' : 'No' }}</td>
                    <td>{{ $subject->no_text_booklet ? 'Yes' : 'No' }}</td>
                    <td>{{ $subject->is_not_wga ? 'Yes' : 'No' }}</td>
                    <td>{{ $subject->tuition_units }}</td>
                    
                    
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layout>