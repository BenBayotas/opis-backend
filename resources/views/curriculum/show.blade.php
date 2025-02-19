<x-layout>
    <x-slot:title>
        {{ $curriculum->curriculum_year }}
    </x-slot:title>

    <h1>Curriculum {{ $curriculum->curriculum_year }} of {{ $curriculum->course->description }}</h1>

    <!-- Top Section: Display Current Curriculum Year and Course -->
    <div class="grid">
        <label>
            Curriculum Year
            <select name="curriculum_year" id="curriculum_year" disabled>
                <option value="{{ $curriculum->id }}">{{ $curriculum->curriculum_year }}</option>
            </select>
        </label>
        <label>
            Course
            <select name="course" id="course" disabled>
                <option value="{{ $curriculum->course->id }}">{{ $curriculum->course->description }}</option>
            </select>
        </label>
    </div>

    <hr>

    <!-- Section: Add Subjects to a Specific Year & Semester -->
    <h3>Add Curriculum Subjects</h3>
    <div class="grid">
        <label>
            Year
            <input type="number" id="subjectYear" placeholder="e.g., 1" min="1">
        </label>
        <label>
            Semester
            <select name="semester" id="semester">
                <option value="">Select Semester</option>
                <option value="1">1st Semester</option>
                <option value="2">2nd Semester</option>
                <option value="3">Summer</option>
            </select>
        </label>
    </div>

    <!-- Section: Filter and Search Available Subjects -->
    <div class="grid">
        <label>
            Search Subjects
            <input type="search" id="subjectSearch" placeholder="Search by title...">
        </label>
        <label>
            Filter by Major:
            <select id="filterMajor">
                <option value="">All</option>
                <option value="major">Major</option>
                <option value="nonmajor">Non-Major</option>
            </select>
        </label>
    </div>

    <!-- Section: Available Subjects and Selected Subjects -->
    <div class="grid">
        <!-- Available Subjects Table -->
        <div>
            <h4>Available Subjects</h4>
            <table id="availableSubjectsTable">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Subject Code</th>
                        <th>Subject Title</th>
                        <th>Is Major</th>
                        <th>Credited Units</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr data-is-major="{{ $subject->is_major ? 'major' : 'nonmajor' }}" data-title="{{ strtolower($subject->subject_title) }}">
                            <td>
                                <input type="checkbox" class="subject-checkbox" value="{{ $subject->id }}">
                            </td>
                            <td>{{ $subject->subject_code }}</td>
                            <td>{{ $subject->subject_title }}</td>
                            <td>{{ $subject->is_major ? 'Yes' : 'No' }}</td>
                            <td>{{ $subject->credited_units }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Selected Subjects List -->
        <div>
            <h4>Selected Subjects</h4>
            <ul id="selectedSubjectsList">
                <!-- Dynamically updated list of selected subjects -->
            </ul>
        </div>
    </div>

    <!-- Button to Submit Selected Subjects -->
    <div>
        <button id="addSubjectsButton">Add Selected Subjects</button>
    </div>

    <hr>

    <!-- Section: Display Existing Curriculum Subjects -->
    @foreach ($curriculum->curriculumYears as $year)
        <div>
            <h4>Year {{ $year->year }}</h4>
            @foreach ($year->semesters as $sem)
                <h5>{{ ucfirst($sem->title) }} Semester</h5>
                <table>
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Title</th>
                            <th>Area</th>
                            <th>Quota</th>
                            <th>LEC</th>
                            <th>LAB</th>
                            <th>Credited Units</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sem->subjects as $sub)
                            <tr>
                                <td>{{ $sub->subject_code }}</td>
                                <td>{{ $sub->subject_title }}</td>
                                <td>{{ $sub->pivot->curriculum_semester_area_id }}</td>
                                <td>{{ $sub->pivot->quota }}</td>
                                <td>{{ $sub->lec_hours }}</td>
                                <td>{{ $sub->lab_hours }}</td>
                                <td>{{ $sub->credited_units }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    @endforeach

    <!-- Front-End Integration & AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subjectSearch = document.getElementById('subjectSearch');
            const filterMajor = document.getElementById('filterMajor');
            const availableSubjectsTableBody = document.getElementById('availableSubjectsTable').querySelector('tbody');
            const selectedSubjectsList = document.getElementById('selectedSubjectsList');
            const addSubjectsButton = document.getElementById('addSubjectsButton');

            // Update the list of selected subjects whenever a checkbox changes.
            function updateSelectedSubjects() {
                selectedSubjectsList.innerHTML = '';
                document.querySelectorAll('.subject-checkbox:checked').forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const subjectTitle = row.cells[2].innerText;
                    const li = document.createElement('li');
                    li.textContent = subjectTitle;
                    selectedSubjectsList.appendChild(li);
                });
            }

            // Add event listeners for checkboxes.
            document.querySelectorAll('.subject-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedSubjects);
            });

            // Filter available subjects based on search input and major filter.
            function filterSubjects() {
                const searchTerm = subjectSearch.value.toLowerCase();
                const majorFilter = filterMajor.value; // "major", "nonmajor", or ""
                Array.from(availableSubjectsTableBody.rows).forEach(row => {
                    const title = row.dataset.title; // subject title in lowercase
                    const isMajor = row.dataset.isMajor; // "major" or "nonmajor"
                    let show = true;
                    if (searchTerm && !title.includes(searchTerm)) {
                        show = false;
                    }
                    if (majorFilter && isMajor !== majorFilter) {
                        show = false;
                    }
                    row.style.display = show ? '' : 'none';
                });
            }

            subjectSearch.addEventListener('input', filterSubjects);
            filterMajor.addEventListener('change', filterSubjects);

            // Handle the add subjects button click event.
            addSubjectsButton.addEventListener('click', function () {
                const selectedIds = Array.from(document.querySelectorAll('.subject-checkbox:checked')).map(cb => cb.value);
                const year = document.getElementById('subjectYear').value;
                const semester = document.getElementById('semester').value;

                if (!year || !semester || selectedIds.length === 0) {
                    alert('Please enter a year, select a semester, and choose at least one subject.');
                    return;
                }

                // Send an AJAX request to add the selected subjects.
                fetch('{{ route("curriculum.addSubjects", $curriculum->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        year: parseInt(year),
                        semester: parseInt(semester),
                        subjects: selectedIds
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    // Optionally, update the curriculum display or reload the page.
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error adding subjects.');
                });
            });
        });
    </script>
</x-layout>
