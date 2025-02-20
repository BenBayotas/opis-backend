<x-layout>
    <x-slot:title>
        Manage Requisites for {{ $subject->title }}
    </x-slot:title>

    <h1>Manage Requisites for Subject: {{ $subject->title }}</h1>
    <p>
        Curriculum: {{ $curriculum->curriculum_year }} ({{ $curriculum->course->description }})
    </p>

    @php
        // Build arrays of IDs from the subject's relations filtered by the current curriculum.
        $prereqIds = $subject->prerequisites
                        ->filter(fn($prereq) => $prereq->pivot->curriculum_id == $curriculum->id)
                        ->pluck('id')->toArray();
        $coreqIds = $subject->corequisites
                        ->filter(fn($coreq) => $coreq->pivot->curriculum_id == $curriculum->id)
                        ->pluck('id')->toArray();
        $equivIds = $subject->equivalents
                        ->filter(fn($equiv) => $equiv->pivot->curriculum_id == $curriculum->id)
                        ->pluck('id')->toArray();
    @endphp

    <form action="{{ route('subject.requisites.store') }}" method="POST">
        @csrf
        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
        <input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">

        <!-- Prerequisites Section -->
        <section style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
            <h2>Prerequisites</h2>

            <div class="grid">
                <label>
                    Search Prerequisites:
                    <input type="search" id="prereqSearch" placeholder="Search...">
                </label>
            </div>
            <!-- Selected Prerequisites List -->
            <div class="grid">
                <div style="max-height:200px; overflow-y:auto;">
                    <ul id="prereqList" style="list-style-type:none; padding:0;">
                        @foreach($allSubjects as $option)
                            @if($option->id != $subject->id)
                                <li data-title="{{ strtolower($option->title) }}">
                                    <label>
                                        <input type="checkbox" name="prerequisites[]" value="{{ $option->id }}"
                                            {{ in_array($option->id, old('prerequisites', $prereqIds)) ? 'checked' : '' }}>
                                        {{ $option->title }}
                                    </label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div>
                    <strong>Selected Prerequisites:</strong>
                    <ul id="selectedPrereqList" style="list-style-type:none; padding:0;"></ul>
                </div>
            </div>
           
        </section>

        <!-- Corequisites Section -->
        <section style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
            <h2>Corequisites</h2>
            <label>
                Search Corequisites:
                <input type="search" id="coreqSearch" placeholder="Search...">
            </label>
            <!-- Selected Corequisites List -->
            
            <div class="grid">
                <div style="max-height:200px; overflow-y:auto;">
                    <ul id="coreqList" style="list-style-type:none; padding:0;">
                        @foreach($allSubjects as $option)
                            @if($option->id != $subject->id)
                                <li data-title="{{ strtolower($option->title) }}">
                                    <label>
                                        <input type="checkbox" name="corequisites[]" value="{{ $option->id }}"
                                            {{ in_array($option->id, old('corequisites', $coreqIds)) ? 'checked' : '' }}>
                                        {{ $option->title }}
                                    </label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div>
                    <strong>Selected Corequisites:</strong>
                    <ul id="selectedCoreqList" style="list-style-type:none; padding:0;"></ul>
                </div>
            </div>
            
            
        </section>

        <!-- Equivalent Subjects Section -->
        <section style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
            <h2>Equivalent Subjects</h2>

        
            <label>
                Search Equivalents:
                <input type="search" id="equivSearch" placeholder="Search...">
            </label>
            <!-- Selected Equivalents List -->

            <div class="grid">
                <div style="max-height:200px; overflow-y:auto;">
                    <ul id="equivList" style="list-style-type:none; padding:0;">
                        @foreach($allSubjects as $option)
                            @if($option->id != $subject->id)
                                <li data-title="{{ strtolower($option->title) }}">
                                    <label>
                                        <input type="checkbox" name="equivalents[]" value="{{ $option->id }}"
                                            {{ in_array($option->id, old('equivalents', $equivIds)) ? 'checked' : '' }}>
                                        {{ $option->title }}
                                    </label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div>
                    <strong>Selected Equivalents:</strong>
                    <ul id="selectedEquivList" style="list-style-type:none; padding:0;"></ul>
                </div>
            </div>
            
            
        </section>

        <button type="submit">Save</button>
    </form>

    <a href="{{ route('curriculum.show', ['curriculum' => $curriculum->id]) }}">Back to Curriculum</a>

    <!-- JavaScript for search and selected list functionality -->
    <script>
        // Function to update a selected list for a given section.
        function updateSelectedList(listId, selectedListId) {
            const list = document.getElementById(listId);
            const selectedList = document.getElementById(selectedListId);
            selectedList.innerHTML = '';
            list.querySelectorAll('input[type="checkbox"]:checked').forEach(cb => {
                const label = cb.parentElement.innerText.trim();
                const li = document.createElement('li');
                li.textContent = label;
                selectedList.appendChild(li);
            });
        }

        // Function to filter list items based on search input.
        function filterList(searchId, listId) {
            const searchTerm = document.getElementById(searchId).value.toLowerCase();
            const list = document.getElementById(listId);
            Array.from(list.children).forEach(li => {
                const title = li.dataset.title || '';
                li.style.display = title.includes(searchTerm) ? '' : 'none';
            });
        }

        // Setup search and update events for each section.
        document.addEventListener('DOMContentLoaded', function () {
            // Prerequisites section
            const prereqSearch = document.getElementById('prereqSearch');
            prereqSearch.addEventListener('input', function () {
                filterList('prereqSearch', 'prereqList');
            });
            document.querySelectorAll('#prereqList input[type="checkbox"]').forEach(cb => {
                cb.addEventListener('change', function () {
                    updateSelectedList('prereqList', 'selectedPrereqList');
                });
            });
            updateSelectedList('prereqList', 'selectedPrereqList');

            // Corequisites section
            const coreqSearch = document.getElementById('coreqSearch');
            coreqSearch.addEventListener('input', function () {
                filterList('coreqSearch', 'coreqList');
            });
            document.querySelectorAll('#coreqList input[type="checkbox"]').forEach(cb => {
                cb.addEventListener('change', function () {
                    updateSelectedList('coreqList', 'selectedCoreqList');
                });
            });
            updateSelectedList('coreqList', 'selectedCoreqList');

            // Equivalents section
            const equivSearch = document.getElementById('equivSearch');
            equivSearch.addEventListener('input', function () {
                filterList('equivSearch', 'equivList');
            });
            document.querySelectorAll('#equivList input[type="checkbox"]').forEach(cb => {
                cb.addEventListener('change', function () {
                    updateSelectedList('equivList', 'selectedEquivList');
                });
            });
            updateSelectedList('equivList', 'selectedEquivList');
        });
    </script>
</x-layout>
