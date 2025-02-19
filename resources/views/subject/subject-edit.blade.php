<x-layout>
    <x-slot:title>
        Edit Subject
    </x-slot:title>

    <h1>Edit Subject</h1>

    <form action="{{ route('subject.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Row 1: Subject Group, Code, Title, Is Major -->
        <div class="grid">
            <label>
                Subject Group
                <select name="subject_group_id">
                    @foreach($subjectGroups as $group)
                        <option value="{{ $group->id }}" 
                            {{ old('subject_group_id', $subject->subject_group_id) == $group->id ? 'selected' : '' }}>
                            {{ $group->title }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Subject Code
                <input type="text" name="subject" value="{{ old('code', $subject->code) }}">
            </label>

            <label>
                Subject Title
                <input type="text" name="title" value="{{ old('title', $subject->title) }}">
            </label>

            <label>
                Is Major
                <select name="is_major">
                    <option value="1" {{ old('is_major', $subject->is_major) == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_major', $subject->is_major) == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>
        </div>

        <!-- Row 2: Department, Credited Units, LEC Hours, LAB Hours -->
        <div class="grid">
            <label>
                Department
                <select name="department_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" 
                            {{ old('department_id', $subject->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->title }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Credited Units
                <input type="number" name="credited_units" value="{{ old('credited_units', $subject->credited_units) }}">
            </label>

            <label>
                LEC Hours
                <input type="number" name="lec_hours" value="{{ old('lec_hours', $subject->lec_hours) }}">
            </label>

            <label>
                LAB Hours
                <input type="number" name="lab_hours" value="{{ old('lab_hours', $subject->lab_hours) }}">
            </label>
        </div>

        <!-- Row 3: Special, Elective, No Text Booklet, Is Not WGA -->
        <div class="grid">
            <label>
                Special
                <select name="special">
                    <option value="1" {{ old('special', $subject->special) == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('special', $subject->special) == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>

            <label>
                Elective
                <select name="elective">
                    <option value="1" {{ old('elective', $subject->elective) == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('elective', $subject->elective) == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>

            <label>
                No Text Booklet
                <select name="no_text_booklet">
                    <option value="1" {{ old('no_text_booklet', $subject->no_text_booklet) == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('no_text_booklet', $subject->no_text_booklet) == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>

            <label>
                Is Not WGA
                <select name="is_not_wga">
                    <option value="1" {{ old('is_not_wga', $subject->is_not_wga) == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_not_wga', $subject->is_not_wga) == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>
        </div>

        <!-- Row 4: Category and Tuition Units -->
        <div class="grid">
            <label>
                Category
                <select name="category_id">
                    @foreach($subjectCategories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id', $subject->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Tuition Units
                <input type="number" name="tuition_units" value="{{ old('tuition_units', $subject->tuition_units) }}">
            </label>
        </div>

        <button type="submit">Update Subject</button>
    </form>
</x-layout>