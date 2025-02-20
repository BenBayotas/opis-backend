    <h2>Course List</h2>
    <table>
        <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Code</th>
                <th>Department</th>
                <th>Description</th>
                <th>Acronym</th>
                <th>Major</th>
                <th>Authority No.</th>
                <th>Accreditation Id</th>
                <th>Year Granted</th>
                <th>Years</th>
                <th>Slots</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>
                        <a>Edit</a>
                    </td>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->department->title }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->acronym }}</td>
                    <td>{{ $course->major }}</td>
                    <td>{{ $course->authority_no }}</td>
                    <td>{{ $course->accreditation_id }}</td>
                    <td>{{ $course->year_granted }}</td>
                    <td>{{ $course->years }}</td>
                    <td>{{ $course->slots }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
