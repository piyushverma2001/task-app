<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Tasks') }}
        </h2>
    </x-slot>

    <div class="mb-4">
         <a href="{{ route('admin.tasks.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Create New Task</a>
    </div>

    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sub-Category</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                    {{-- Add Actions column later --}}
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($tasks as $task)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $task->title }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $task->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $task->subCategory->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $task->assignedTo->name ?? 'Unassigned' }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($task->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                @if($task->status == 'in-progress') bg-blue-100 text-blue-800 @endif
                                @if($task->status == 'completed') bg-green-100 text-green-800 @endif">
                                {{ ucfirst(str_replace('-', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $task->createdBy->name ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
</x-admin-layout>