<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'subCategory', 'createdBy'])
            ->where('assigned_to_user_id', Auth::id())
            ->get();

        return view('user.dashboard', compact('tasks'));
    }
}