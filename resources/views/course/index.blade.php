<x-layout>
    <x-slot:title>
        Course Management
    </x-slot:title>

    <!-- Unified Create/Update Form -->
    <section>
        <h2 id="form-title">Add New Course</h2>

        <label>
            Search
            <input
                type="text"
                name="search"
                hx-get="{{ route('course.search') }}"
                hx-trigger="input changed delay:500ms, keyup[key=='Enter'], load"
                hx-target="#course-list"
                hx-swap="innerHTML"
            >
        </label>

        <form id="course-form" action="{{ route('course.store') }}" method="POST">
            @csrf
            <!-- The _method hidden input will be added when editing -->
            <div class="grid">
                <label>
                    Department
                    <select name="department_id" id="department_id">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->title }}</option>
                        @endforeach
                    </select>
                </label>

                <label>
                    Code
                    <input type="text" name="code" id="code" value="{{ old('code') }}">
                </label>

                <label>
                    Acronym
                    <input type="text" name="acronym" id="acronym" value="{{ old('acronym') }}">
                </label>
            </div>

            <div class="grid">
                <label>
                    Description
                    <input type="text" name="description" id="description" value="{{ old('description') }}">
                </label>

                <label>
                    Major
                    <input type="text" name="major" id="major" value="{{ old('major') }}">
                </label>

                <label>
                    Authority No.
                    <input type="text" name="authority_no" id="authority_no" value="{{ old('authority_no') }}">
                </label>

                <label>
                    Accreditation Id
                    <input type="text" name="accreditation_id" id="accreditation_id" value="{{ old('accreditation_id') }}">
                </label>
            </div>

            <div class="grid">
                <label>
                    Year Granted
                    <input type="text" name="year_granted" id="year_granted" value="{{ old('year_granted') }}">
                </label>

                <label>
                    Years
                    <input type="number" name="years" id="years" value="{{ old('years') }}">
                </label>

                <label>
                    Slots
                    <input type="number" name="slots" id="slots" value="{{ old('slots') }}">
                </label>
            </div>

            <button type="submit" id="submit-button">Add New Course</button>
        </form>
    </section>

    <hr>

    <!-- Course List -->
    <section id="course-list">
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
                            <a href="javascript:void(0)"
                               onclick="populateForm(
                                   '{{ $course->id }}',
                                   '{{ $course->department_id }}',
                                   '{{ addslashes($course->code) }}',
                                   '{{ addslashes($course->acronym) }}',
                                   '{{ addslashes($course->description) }}',
                                   '{{ addslashes($course->major) }}',
                                   '{{ addslashes($course->authority_no) }}',
                                   '{{ addslashes($course->accreditation_id) }}',
                                   '{{ $course->year_granted }}',
                                   '{{ $course->years }}',
                                   '{{ $course->slots }}'
                               )">
                                Edit
                            </a>
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
    </section>

    <!-- JavaScript to populate the form with course data -->
    <script>
        function populateForm(id, department_id, code, acronym, description, major, authority_no, accreditation_id, year_granted, years, slots) {
            var form = document.getElementById('course-form');

            // Update form action to the update route (e.g., /course/{id})
            form.action = '/course/' + id;

            // Add (or update) the hidden _method input to simulate PUT
            var methodInput = document.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            // Populate the fields
            document.getElementById('department_id').value = department_id;
            document.getElementById('code').value = code;
            document.getElementById('acronym').value = acronym;
            document.getElementById('description').value = description;
            document.getElementById('major').value = major;
            document.getElementById('authority_no').value = authority_no;
            document.getElementById('accreditation_id').value = accreditation_id;
            document.getElementById('year_granted').value = year_granted;
            document.getElementById('years').value = years;
            document.getElementById('slots').value = slots;

            // Change the form title and submit button text
            document.getElementById('form-title').textContent = 'Edit Course #' + id;
            document.getElementById('submit-button').textContent = 'Update Course';
        }
    </script>
</x-layout>
