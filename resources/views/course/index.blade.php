<x-layout>
    <x-slot:title>
        Course Management
    </x-slot:title>

    <!-- Create New Course Form -->
    <section>
        <h2>Create New Course</h2>
        <form action="{{ route('course.store') }}" method="POST" id="create-course-form">
            @csrf
            <div class="grid">
                <label>
                    Department
                    <select name="department_id">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->title }}</option>
                        @endforeach
                    </select>
                </label>

                <label>
                    Code
                    <input type="text" name="code" value="{{ old('code') }}">
                </label>

                <label>
                    Acronym
                    <input type="text" name="acronym" value="{{ old('acronym') }}">
                </label>
            </div>

            <div class="grid">
                <label>
                    Description
                    <input type="text" name="description" value="{{ old('description') }}">
                </label>

                <label>
                    Major
                    <input type="text" name="major" value="{{ old('major') }}">
                </label>

                <label>
                    Authority No.
                    <input type="text" name="authority_no" value="{{ old('authority_no') }}">
                </label>

                <label>
                    Accreditation Id
                    <input type="text" name="accreditation_id" value="{{ old('accreditation_id') }}">
                </label>
            </div>

            <div class="grid">
                <label>
                    Year Granted
                    <input type="text" name="year_granted" value="{{ old('year_granted') }}">
                </label>

                <label>
                    Years
                    <input type="number" name="years" value="{{ old('years') }}">
                </label>

                <label>
                    Slots
                    <input type="number" name="slots" value="{{ old('slots') }}">
                </label>
            </div>

            <button type="submit">Add New Course</button>
        </form>
    </section>

    <hr>

    <!-- Courses List -->
    <section>
        <h2>Courses</h2>
        <table>
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>ID</th>
                    <th>Program Code</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Major</th>
                    <th>Accreditation</th>
                    <th>Authority No.</th>
                    <th>Year Granted</th>
                    <th>Program Type</th>
                    <th>Years</th>
                    <th>Slots</th>
                </tr>
            </thead>
            <tbody id="course-list">
                @foreach ($courses as $course)
                    <tr id="course-{{ $course->id }}">
                        <td>
                            <!-- Using htmx to load the edit form inline -->
                            <a role="button" 
                               hx-get="{{ route('course.edit', $course->id) }}" 
                               hx-target="#edit-section" 
                               hx-swap="innerHTML">
                                Edit
                            </a>
                            <!-- Optionally, add a delete button here -->
                        </td>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->code }}</td>
                        <td>{{ $course->department->title }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->major }}</td>
                        <td>{{ $course->accreditation_id }}</td>
                        <td>{{ $course->authority_no }}</td>
                        <td>{{ $course->year_granted }}</td>
                        <td>{{ $course->department->program_type->title ?? 'N/A' }}</td>
                        <td>{{ $course->years }}</td>
                        <td>{{ $course->slots }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Edit Section: Inline edit form will be loaded here via htmx -->
    <section id="edit-section">
        {{-- The edit form will be injected here when you click "Edit" --}}
    </section>
</x-layout>