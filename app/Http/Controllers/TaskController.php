<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:255'],
            'description' => 'required|max:500',
            'status' => 'required'
        ], [
            'title.regex' => 'Only numbers are allowed in the title; letters are not permitted.',
            'description.max' => 'Description 500 characters only.'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect('/');
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect('/');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:255'],
            'description' => 'required|max:500',
        ], [
            'title.regex' => 'Only numbers are allowed in the title; letters are not permitted.
',
            'description.max' => 'Max 500 characters allowed.'
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect('/');
    }

    public function markComplete($id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'status' => 'completed'
        ]);

        return redirect('/');
    }
}