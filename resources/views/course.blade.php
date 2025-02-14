<x-layout>
<x-slot:title>
Course File
</x-slot:title>

<form action="" method="POST">
    <div class="grid">
        <label>
            Department
            <select name="department">
            @foreach ($departments as $department)
                <option value={{ $department->id }}>{{ $department->title }}</option>
            @endforeach
            </select>
        </label>

        <label>
            Code
            <input type="text" name="code">
        </label>

        <label>
            Acronym
            <input type="text" name="acronym">
        </label>
    </div>

    <div class="grid">
        <label>
            Description
            <input type="text" name="description">
        </label>

        <label>
            Major
            <input type="text" name="major">
        </label>

        <label>
            authority number
            <input type="text" name="authority_no">
        </label>

        <label>
            accreditation id
            <input type="text" name="accreditation_id">
        </label>
    </div>

    <div class="grid">
        <label>
            year granted
            <input type="year" name="year_granted">
        </label>

        <label>
            years
            <input type="number" name="years">
        </label>

        <label>
            slots
            <input type="number" name="slots">
        </label>
    </div>
    <input type="submit" value="submit">
</form>

<h1>Courses:</h1>
<table>
    <thead>
        <tr>
            <th scole="col">id</th>
            <th scole="col">program code</th>
            <th scole="col">department</th>
            <th scole="col">description</th>
            <th scole="col">major</th>
            <th scole="col">accreditation</th>
            <th scole="col">authority no</th>
            <th scole="col">year granted</th>
            <th scole="col">program type</th>
            <th scole="col">years</th>
            <th scole="col">slots</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($courses as $course)
    <tr>
        <td>{{$course->id}}</td>
        <td>{{$course->code}}</td>
        <td>{{$course->department->title}}</td>
        <td>{{$course->description}}</td>
        <td>{{$course->major}}</td>
        <td>{{$course->accreditation}}</td>
        <td>{{$course->authority_no}}</td>
        <td>{{$course->year_granted}}</td>
        <td>{{$course->year}}</td>
        <td>{{$course->slots}}</td>
    </tr>
    @endforeach

    </tbody>

    <tfoot>
    </tfoot>
</table>

</x-layout>
