<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $tasks = Task::with(['category', 'subCategory', 'createdBy'])
            ->where('assigned_to_user_id', auth()->id())
            ->get();
            
        return view('user.dashboard', compact('tasks'));
    }

    public function viewTask($id)
    {
        $task = Task::with(['category', 'subCategory', 'createdBy'])
            ->where('assigned_to_user_id', auth()->id())
            ->findOrFail($id);
            
        return view('user.task-details', compact('task'));
    }
} 