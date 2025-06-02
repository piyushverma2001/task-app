<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <a href="{{ route('user.dashboard') }}" class="text-indigo-600 hover:text-indigo-900">
                            ← Back to Dashboard
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Task Information</h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Title</label>
                                    <div class="mt-1 text-sm text-gray-900">{{ $task->title }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <div class="mt-1 text-sm text-gray-900">{{ $task->description }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <div class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Additional Details</h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Category</label>
                                    <div class="mt-1 text-sm text-gray-900">{{ $task->category->name ?? 'N/A' }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Sub Category</label>
                                    <div class="mt-1 text-sm text-gray-900">{{ $task->subCategory->name ?? 'N/A' }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Due Date</label>
                                    <div class="mt-1 text-sm text-gray-900">{{ $task->due_date }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Created By</label>
                                    <div class="mt-1 text-sm text-gray-900">{{ $task->createdBy->name ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <form method="POST" action="{{ route('user.task.update-status', $task->id) }}" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Update Status</label>
                                <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            @if(session('status'))
                                <div class="mt-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="flex items-center justify-end">
                                <x-primary-button>
                                    {{ __('Update Status') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 