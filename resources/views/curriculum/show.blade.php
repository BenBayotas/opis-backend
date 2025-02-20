<x-layout>
    <x-slot:title>
        {{ $curriculum->year_implemented }}
    </x-slot:title>
    
    <h1>Curriculum {{ $curriculum->year_implemented }} of {{ $curriculum->course->description }}</h1>

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
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr data-is-major="{{ $subject->is_major ? 'major' : 'nonmajor' }}" data-title="{{ strtolower($subject->title) }}">
                            <td>
                                <input type="checkbox" class="subject-checkbox" value="{{ $subject->id }}">
                            </td>
                            <td>{{ $subject->code }}</td>
                            <td>{{ $subject->title }}</td>
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

    <!-- Toggle Button for Table Columns -->
    <div>
        <button onclick="toggleColumns()">Toggle Requisites</button>
    </div>

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
                            <!-- Default columns -->
                            <th class="default-data">LEC</th>
                            <th class="default-data">LAB</th>
                            <th class="default-data">Credited Units</th>
                            <th class="default-data">Prerequisites</th>
                            <th class="default-data">Actions</th>
                            <!-- Requisites columns (initially hidden) -->
                            <th class="requisite-data" style="display:none;">Pre-Requisites</th>
                            <th class="requisite-data" style="display:none;">Co-Requisites</th>
                            <th class="requisite-data" style="display:none;">Equivalent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sem->subjects as $sub)
                            <tr id="semester-{{ $sem->id }}-subject-{{ $sub->id }}">
                                <td>{{ $sub->code }}</td>
                                <td>{{ $sub->title }}</td>
                                <td>{{ $sub->pivot->curriculum_semester_area_id }}</td>
                                <td>{{ $sub->pivot->quota }}</td>
                                <!-- Default columns -->
                                <td class="default-data">{{ $sub->lec_hours }}</td>
                                <td class="default-data">{{ $sub->lab_hours }}</td>
                                <td class="default-data">{{ $sub->credited_units }}</td>
                                <td class="default-data">
                                    <a href="{{ route('subject.manageRequisites', ['subject' => $sub->id, 'curriculum' => $curriculum->id]) }}">
                                        Manage Requisites
                                    </a>
                                </td>
                                <td class="default-data">
                                    <button class="delete-subject" data-semester-id="{{ $sem->id }}" data-subject-id="{{ $sub->id }}">Delete</button>
                                </td>
                                <!-- Requisites columns -->
                                <td class="requisite-data" style="display:none;">
                                    @foreach($sub->prerequisites as $prereq)
                                        @if($prereq->pivot->curriculum_id == $curriculum->id)
                                            {{ $prereq->title }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="requisite-data" style="display:none;">
                                    @foreach($sub->corequisites as $coreq)
                                        @if($coreq->pivot->curriculum_id == $curriculum->id)
                                            {{ $coreq->title }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="requisite-data" style="display:none;">
                                    @foreach($sub->equivalents as $equiv)
                                        @if($equiv->pivot->curriculum_id == $curriculum->id)
                                            {{ $equiv->title }}<br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    @endforeach

    <!-- Define a JS variable for the curriculum id -->
    <script>
        const curriculumId = {{ $curriculum->id }};
    </script>

    <!-- JavaScript for toggling columns and other interactivity -->
    <script>
        let showingRequisites = false;
        function toggleColumns() {
            const defaultCells = document.querySelectorAll('.default-data');
            const requisiteCells = document.querySelectorAll('.requisite-data');
            if (showingRequisites) {
                defaultCells.forEach(cell => cell.style.display = '');
                requisiteCells.forEach(cell => cell.style.display = 'none');
                showingRequisites = false;
            } else {
                defaultCells.forEach(cell => cell.style.display = 'none');
                requisiteCells.forEach(cell => cell.style.display = '');
                showingRequisites = true;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const subjectSearch = document.getElementById('subjectSearch');
            const filterMajor = document.getElementById('filterMajor');
            const availableSubjectsTableBody = document.getElementById('availableSubjectsTable').querySelector('tbody');
            const selectedSubjectsList = document.getElementById('selectedSubjectsList');
            const addSubjectsButton = document.getElementById('addSubjectsButton');

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

            document.querySelectorAll('.subject-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedSubjects);
            });

            function filterSubjects() {
                const searchTerm = subjectSearch.value.toLowerCase();
                const majorFilter = filterMajor.value;
                Array.from(availableSubjectsTableBody.rows).forEach(row => {
                    const title = row.dataset.title;
                    const isMajor = row.dataset.isMajor;
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

            addSubjectsButton.addEventListener('click', function () {
                const selectedIds = Array.from(document.querySelectorAll('.subject-checkbox:checked')).map(cb => cb.value);
                const year = document.getElementById('subjectYear').value;
                const semester = document.getElementById('semester').value;
                if (!year || !semester || selectedIds.length === 0) {
                    alert('Please enter a year, select a semester, and choose at least one subject.');
                    return;
                }
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
                    // Optionally update the curriculum display or reload the page.
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error adding subjects.');
                });
            });

            document.querySelectorAll('.delete-subject').forEach(button => {
                button.addEventListener('click', function () {
                    const semesterId = this.dataset.semesterId;
                    const subjectId = this.dataset.subjectId;
                    if (!confirm('Are you sure you want to delete this subject from the curriculum?')) {
                        return;
                    }
                    fetch(`{{ url('/curriculum') }}/${curriculumId}/semester/${semesterId}/subject/${subjectId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);
                        const row = document.getElementById(`semester-${semesterId}-subject-${subjectId}`);
                        if (row) row.remove();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error removing subject.');
                    });
                });
            });
        });
    </script>
</x-layout>
