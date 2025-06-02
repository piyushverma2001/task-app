<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->assignedTasks()
                        ->with(['category', 'subCategory', 'createdBy'])
                        ->latest()
                        ->paginate(10);
        return view('user.tasks.index', compact('tasks'));
    }
}