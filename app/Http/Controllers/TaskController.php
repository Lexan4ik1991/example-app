<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'tasks' => Task::orderBy('created_at', 'asc')->get(),
        ]);
    }

    public function dashboard()
    {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get(),
        ]);
    }

    public function addTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/dash');
    }

    public function deleteTask($id)
    {
        Task::findOrFail($id)->delete();

        return redirect('/dash');
    }

    public function logout()
    {

    }

}
