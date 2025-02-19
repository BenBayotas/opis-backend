<x-layout>
    <x-slot:title>
        {{ $curriculum->year_implemented }}
    </x-slot:title>


    <h1>Curriculum {{ $curriculum->year_implemented }} of {{ $curriculum->course->description }}</h1>

    <a role="button" href="{{ route('curriculum.edit', $curriculum) }}">Edit</a>

    @foreach ($curriculum->curriculumYears as $year)
    <div>
        <h2>Year {{ $year->year }}</h2>

        @foreach ($year->semesters as $sem)
        <h3>{{ $sem->title }}</h3>
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
                <td>{{ $sub->code }}</td>
                <td>{{ $sub->title }}</td>
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
