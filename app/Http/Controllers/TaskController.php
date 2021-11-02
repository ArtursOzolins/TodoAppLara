<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    public function index()
    {
        return view('tasks/indexTask', ['tasks' => Task::all()]);
    }

    public function create()
    {
        return view('tasks/taskCreateForm');
    }

    public function store(Request $request)
    {
        (new Task([
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ]))->save();
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Task $task)
    {
        return view('tasks/editTaskForm', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ]);
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
