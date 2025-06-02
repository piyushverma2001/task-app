<!-- <x-admin-layout> {{-- Assuming you created an admin layout component or use @extends --}} -->
@extends('layouts.admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <p>Welcome to the Admin Dashboard!</p>
    {{-- Add stats or quick links here --}}
    {{-- <p>Total Users: {{ $userCount ?? 'N/A' }}</p> --}}
    {{-- <p>Total Tasks: {{ $taskCount ?? 'N/A' }}</p> --}}

    <div class="mt-4">
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Register New User</a>
        <a href="{{ route('admin.tasks.create') }}" class="ml-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Create New Task</a>
        <a href="{{ route('admin.users.index') }}" class="ml-4 px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">View All Users</a>
        <a href="{{ route('admin.tasks.index') }}" class="ml-4 px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">View All Tasks</a>
    </div>

</x-admin-layout>