<x-layout>
    <x-slot:title>
        {{ $curriculum->curriculum_year }}
    </x-slot:title>


    <h1>Curriculum {{ $curriculum->curriculum_year }} of {{ $curriculum->course->description }}</h1>

     {{-- <a role="button" href="{{ route('curriculum.edit', $curriculum) }}">Edit</a> --}}
    
    <div class="grid">
        <label>
            Curriculum Year
            <select name="curriculum_year" id="curriculum_year">
                    <option></option>
            </select>
        </label>

        <label>
            Course
            <select name="course" id="course">
                <option></option>
            </select>
        </label>
    </div>

    <h3>Add Curriculum Subjects</h3>

    <div class="grid">
        <label>
            Year
            <input type="text">
        </label>

        <label>
            Semester
            <select name="semester" id="semester">
                <option></option>
            </select>
        </label>
    </div>

    <div class="grid">
        <label>
            All Subjects
            <select name="subject_major" id="subject_major">
                <option></option>
            </select>
        </label>

        <label>
            Search Subjects
            <input type="search">
        </label>

        <label>
            Filter Selected Subjects
            <input type="checkbox">
        </label>
    </div>
    
    <div class="grid">
        <label>
            All Available Subjects 
        
        </label>

        <label>
            Filter Selected Subjects
            <input type="checkbox">
        </label>

        <label>
            Selected Subjects 
        </label>
    </div>

    <div>
        <label>
            <button>Add Subjects</button>
        </label>
    </div>

    @foreach ($curriculum->curriculumYears as $year)
    <div>
        <h4>Year {{ $year->year }}</h4>

        @foreach ($year->semesters as $sem)
        <h5>{{ $sem->title }}</h5>
        <table>
            <thead>
                <th scope="col">Subject Code</th>
                <th scope="col">Description</th>
                <th scope="col">Group</th>
                <th scope="col">Quota Grade</th>
                <th scope="col">Lec</th>
                <th scope="col">Lab</th>
                <th scope="col">Credited Units</th>
            </thead>
            <tbody>

            @foreach ($sem->subjects as $sub)
            <tr>
                <td>{{ $sub->subject_code }}</td>
                <td>{{ $sub->subject_title }}</td>
                <!--areas aren't populated yet but it should work-->
                <td>wip</td>
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

</x-layout>
