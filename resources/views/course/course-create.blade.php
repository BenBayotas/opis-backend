
    <form action="store" method="POST">
        @csrf
        <h1>Course File</h1>
        <div class="grid">
        
            <label>
                Department
                <select name="department_id">
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
                Authority No.
                <input type="text" name="authority_no">
            </label>
    
            <label>
                Accreditation Id
                <input type="text" name="accreditation_id">
            </label>
        </div>
    
        <div class="grid">
            <label>
                Year Granted
                <input type="year" name="year_granted">
            </label>
    
            <label>
                Years
                <input type="number" name="years">
            </label>
    
            <label>
                Slots
                <input type="number" name="slots">
            </label>
        </div>
        <button type="submit">Add New Course</button>
    </form>
</body>
</html>