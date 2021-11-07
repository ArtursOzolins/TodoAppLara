<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = auth()->user()->tasks()->paginate(10);
        return view('tasks/indexTask', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks/taskCreateForm');
    }

    public function store(Request $request): RedirectResponse
    {
        $task = (new Task([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'recycled' => 'no'
        ]));

        $task->user()->associate(auth()->user());
        $task->save();
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

    public function recycleBin()
    {
        $tasks = auth()->user()->tasks()->paginate(10);
        return view('tasks/recycleBin', ['tasks' => $tasks]);
    }

    public function changeRecycle(Task $task): RedirectResponse
    {
        $task->toggleRecycle();
        $task->save();
        return redirect()->back();
    }
}
