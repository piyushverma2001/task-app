<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Task') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.tasks.store') }}">
        @csrf

        <div class="mt-4">
            <label for="title" class="block font-medium text-sm text-gray-700">{{ __('Title') }}</label>
            <input id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="title" value="{{ old('title') }}" required autofocus />
        </div>

        <div class="mt-4">
            <label for="description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
            <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">{{ old('description') }}</textarea>
        </div>

        <div class="mt-4">
            <label for="category_id" class="block font-medium text-sm text-gray-700">{{ __('Category') }}</label>
            <select id="category_id" name="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label for="sub_category_id" class="block font-medium text-sm text-gray-700">{{ __('Sub-Category') }}</label>
            <select id="sub_category_id" name="sub_category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                <option value="">Select Category First</option>
                {{-- Options will be populated by JavaScript --}}
                {{-- For handling old input on validation failure, this part needs more advanced JS or server-side logic --}}
            </select>
        </div>
        
        <div class="mt-4">
            <label for="assigned_to_user_id" class="block font-medium text-sm text-gray-700">{{ __('Assign to User (Optional)') }}</label>
            <select id="assigned_to_user_id" name="assigned_to_user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                <option value="">None</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('assigned_to_user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label for="status" class="block font-medium text-sm text-gray-700">{{ __('Status') }}</label>
            <select id="status" name="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in-progress" {{ old('status') == 'in-progress' ? 'selected' : '' }}>In-Progress</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mt-4">
            <label for="due_date" class="block font-medium text-sm text-gray-700">{{ __('Due Date (Optional)') }}</label>
            <input id="due_date" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="date" name="due_date" value="{{ old('due_date') }}" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">
                {{ __('Create Task') }}
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const subCategorySelect = document.getElementById('sub_category_id');
            const oldSubCategoryId = "{{ old('sub_category_id') }}"; // For repopulating on validation error

            function fetchSubcategories(categoryId, selectedSubCategoryId = null) {
                if (!categoryId) {
                    subCategorySelect.innerHTML = '<option value="">Select Category First</option>';
                    return;
                }

                subCategorySelect.innerHTML = '<option value="">Loading...</option>';
                // Adjust URL if your route is different or has a prefix
                fetch(`/subcategories/${categoryId}`) 
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        subCategorySelect.innerHTML = '<option value="">Select Sub-Category</option>';
                        data.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            if (selectedSubCategoryId && subcategory.id == selectedSubCategoryId) {
                                option.selected = true;
                            }
                            subCategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching subcategories:', error);
                        subCategorySelect.innerHTML = '<option value="">Could not load subcategories</option>';
                    });
            }

            categorySelect.addEventListener('change', function () {
                fetchSubcategories(this.value);
            });

            // Trigger on page load if a category is already selected (e.g., due to validation error)
            if (categorySelect.value) {
                fetchSubcategories(categorySelect.value, oldSubCategoryId);
            }
        });
    </script>
</x-admin-layout>