<x-app-layout> {{-- Uses Breeze's default app layout --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in as a regular user! Welcome, {{ Auth::user()->name }}.
                    <div class="mt-4">
                        <a href="{{ route('user.tasks.index') }}" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">View My Tasks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>