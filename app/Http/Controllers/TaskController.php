<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

    public function store(Request $request): RedirectResponse
    {
        (new Task([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'completed_at' => null
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

    public function update(Request $request, Task $task): RedirectResponse
    {
        $task->update([
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ]);
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }


    public function changeStatus(Task $task): RedirectResponse
    {
        $task->toggleStatus();
        $task->save();
        return redirect()->back();
    }
}
