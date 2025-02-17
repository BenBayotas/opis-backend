<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
        >
    <title>Course Lists</title>
</head>
<body>
<h1> Course List</h1>

<table>
    <thead>
        <tr>
            <th >id</th>
            <th>program code</th>
            <th>department</th>
            <th>description</th>
            <th>major</th>
            <th>accreditation</th>
            <th>authority no</th>
            <th>year granted</th>
            <th>program type</th>
            <th>years</th>
            <th>slots</th>
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
                <td>{{$course->department->program_type->title}}</td>
                <td>{{$course->years}}</td>
                <td>{{$course->slots}}</td>
            </tr>
        @endforeach
    
    </tbody>
</table>
    
</body>
</html>