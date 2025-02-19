<x-layout>
    <x-slot:title>
        Add Subject
    </x-slot:title>
    
    <h1>Add Subject/s</h1>

    <a href="{{ route('subject.index') }}">Back</a>
    
    <form action="{{ route('subject.store') }}" method="POST">
        @csrf
        
        <!-- First row: Basic Subject Info -->
        <div class="grid">
            <label>
                Subject Group
                <select name="subject_group_id">
                    @foreach($subjectGroups as $group)
                        <option value="{{ $group->id }}" {{ old('subject_group_id') == $group->id ? 'selected' : '' }}>
                            {{ $group->title }}
                        </option>
                    @endforeach
                </select>
            </label>
            
            <label>
                Subject Code
                <input type="text" name="code" value="{{ old('code') }}">
            </label>
            
            <label>
                Subject Title
                <input type="text" name="title" value="{{ old('title') }}">
            </label>
            
            <label>
                Is Major
                <select name="is_major">
                    <option value="1" {{ old('is_major') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_major') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>
        </div>
        
        <!-- Second row: Department and Hours -->
        <div class="grid">
            <label>
                Department
                <select name="department_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->title }}
                        </option>
                    @endforeach
                </select>
            </label>
            
            <label>
                Credited Units
                <input type="number" name="credited_units" value="{{ old('credited_units') }}">
            </label>
            
            <label>
                LEC Hours
                <input type="number" name="lec_hours" value="{{ old('lec_hours') }}">
            </label>
            
            <label>
                LAB Hours
                <input type="number" name="lab_hours" value="{{ old('lab_hours') }}">
            </label>
        </div>
        
        <!-- Third row: Additional Attributes -->
        <div class="grid">
            <label>
                Special
                <select name="special">
                    <option value="1" {{ old('special') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('special') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>
            
            <label>
                Elective
                <select name="elective">
                    <option value="1" {{ old('elective') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('elective') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>
            
            <label>
                No Text Booklet
                <select name="no_text_booklet">
                    <option value="1" {{ old('no_text_booklet') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('no_text_booklet') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>
            
            <label>
                Is Not WGA
                <select name="is_not_wga">
                    <option value="1" {{ old('is_not_wga') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_not_wga') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>
        </div>
        
        <!-- Fourth row: Category and Tuition -->
        <div class="grid">
            <label>
                Category
                <select name="category_id">
                    @foreach($subjectCategories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </label>
            
            <label>
                Tuition Units
                <input type="number" name="tuition_units" value="{{ old('tuition_units') }}">
            </label>
        </div>
        
        <button type="submit">Add Subject</button>
    </form>
</x-layout>