<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $task              = new Task();
        $task->project_id  = $request->project_id;
        $task->user_id     = Auth::id();
        $task->name        = $request->name;
        $task->description = $request->description;

        $task->save();
        return redirect()->back()->with('success', 'New Task Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update([
            'status' => $request->status
        ]);

        $project = Project::find($task->project_id);
        $tasks = $project->tasks;

        $totalTasks = $tasks->count();
        $totalProgress = 0;

        if ($totalTasks > 0) {
            foreach ($tasks as $t) {
                if ($t->status == 'todo') $totalProgress += 0;
                elseif ($t->status == 'inprogress') $totalProgress += 50;
                elseif ($t->status == 'done') $totalProgress += 100;
            }
            $project->progress = round($totalProgress / $totalTasks);
        } else {
            $project->progress = 0;
        }

        $project->save();

        return response()->json([
            'success' => true,
            'project_progress' => $project->progress
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $project = Project::find($task->project_id);
        $task->delete();

        // Recalculate project progress
        $tasks = $project->tasks;
        $totalTasks = $tasks->count();
        $totalProgress = 0;

        if ($totalTasks > 0) {
            foreach ($tasks as $t) {
                if ($t->status == 'todo') $totalProgress += 0;
                elseif ($t->status == 'inprogress') $totalProgress += 50;
                elseif ($t->status == 'done') $totalProgress += 100;
            }
            $project->progress = round($totalProgress / $totalTasks);
        } else {
            $project->progress = 0;
        }

        $project->save();

        return response()->json([
            'success' => true,
            'project_progress' => $project->progress
        ]);
    }
}
