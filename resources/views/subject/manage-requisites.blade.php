<x-layout>
    <x-slot:title>
        Manage Requisites for {{ $subject->title }}
    </x-slot:title>

    <h1>Manage Requisites for Subject: {{ $subject->title }}</h1>
    <p>
        Curriculum: {{ $curriculum->curriculum_year }} ({{ $curriculum->course->description }})
    </p>

    <!-- Prerequisites Section -->
    <section style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
        <h2>Prerequisites</h2>
        <ul>
            @foreach($subject->prerequisites as $prereq)
                @if($prereq->pivot->curriculum_id == $curriculum->id)
                    <li>
                        {{ $prereq->title }}
                        <form action="{{ route('subject.prerequisite.destroy', ['subjectId' => $subject->id, 'prerequisiteId' => $prereq->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Remove this prerequisite?')">Delete</button>
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>
        <form action="{{ route('subject.prerequisite.store') }}" method="POST">
            @csrf
            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
            <input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">
            <label>
                Add Prerequisite:
                <select name="prerequisite_id" required>
                    <option value="">Select a subject</option>
                    @foreach($allSubjects as $option)
                        @if($option->id != $subject->id)
                            <option value="{{ $option->id }}">{{ $option->title }}</option>
                        @endif
                    @endforeach
                </select>
            </label>
            <button type="submit">Add Prerequisite</button>
        </form>
    </section>

    <!-- Corequisites Section -->
    <section style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
        <h2>Corequisites</h2>
        <ul>
            @foreach($subject->corequisites as $coreq)
                @if($coreq->pivot->curriculum_id == $curriculum->id)
                    <li>
                        {{ $coreq->title }}
                        <form action="{{ route('subject.corequisite.destroy', ['subjectId' => $subject->id, 'corequisiteId' => $coreq->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Remove this corequisite?')">Delete</button>
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>
        <form action="{{ route('subject.corequisite.store') }}" method="POST">
            @csrf
            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
            <input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">
            <label>
                Add Corequisite:
                <select name="corequisite_id" required>
                    <option value="">Select a subject</option>
                    @foreach($allSubjects as $option)
                        @if($option->id != $subject->id)
                            <option value="{{ $option->id }}">{{ $option->title }}</option>
                        @endif
                    @endforeach
                </select>
            </label>
            <button type="submit">Add Corequisite</button>
        </form>
    </section>

    <!-- Equivalents Section -->
    <section style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
        <h2>Equivalent Subjects</h2>
        <ul>
            @foreach($subject->equivalents as $equiv)
                @if($equiv->pivot->curriculum_id == $curriculum->id)
                    <li>
                        {{ $equiv->title }}
                        <form action="{{ route('subject.equivalent.destroy', ['subjectId' => $subject->id, 'equivalentId' => $equiv->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Remove this equivalent?')">Delete</button>
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>
        <form action="{{ route('subject.equivalent.store') }}" method="POST">
            @csrf
            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
            <input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">
            <label>
                Add Equivalent:
                <select name="equivalent_id" required>
                    <option value="">Select a subject</option>
                    @foreach($allSubjects as $option)
                        @if($option->id != $subject->id)
                            <option value="{{ $option->id }}">{{ $option->title }}</option>
                        @endif
                    @endforeach
                </select>
            </label>
            <button type="submit">Add Equivalent</button>
        </form>
    </section>

    <a href="{{ url()->previous() }}">Back to Curriculum</a>
</x-layout>
