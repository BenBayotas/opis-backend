<x-layout>
    <x-slot:title>
        Manage Requisites for {{ $subject->title }}
    </x-slot:title>

    <h1>Manage Requisites for Subject: {{ $subject->title }}</h1>
    <p>
        Curriculum: {{ $curriculum->curriculum_year }} ({{ $curriculum->course->description }})
    </p>

    @php
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
            <div style="max-height:200px; overflow-y:auto;">
                <ul style="list-style-type:none; padding:0;">
                    @foreach($allSubjects as $option)
                        @if($option->id != $subject->id)
                            <li>
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
        </section>

        <!-- Corequisites Section -->
        <section style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
            <h2>Corequisites</h2>
            <div style="max-height:200px; overflow-y:auto;">
                <ul style="list-style-type:none; padding:0;">
                    @foreach($allSubjects as $option)
                        @if($option->id != $subject->id)
                            <li>
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
        </section>

        <!-- Equivalents Section -->
        <section style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
            <h2>Equivalent Subjects</h2>
            <div style="max-height:200px; overflow-y:auto;">
                <ul style="list-style-type:none; padding:0;">
                    @foreach($allSubjects as $option)
                        @if($option->id != $subject->id)
                            <li>
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
        </section>

        <button type="submit">Add Requisites</button>
    </form>

    <a href="{{ route('curriculum.show', ['curriculum' => $curriculum->id]) }}">Back to Curriculum</a>
</x-layout>
