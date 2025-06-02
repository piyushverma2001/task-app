<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'subCategory', 'assignedTo', 'createdBy'])
                     ->latest()
                     ->paginate(10);
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $users = User::where('is_admin', false)->orderBy('name')->get();
        return view('admin.tasks.create', compact('categories', 'users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id,category_id,' . $request->category_id],
            'assigned_to_user_id' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'string', 'in:pending,in-progress,completed'],
            'due_date' => ['nullable', 'date'],
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'assigned_to_user_id' => $request->assigned_to_user_id,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'created_by_user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }
}
