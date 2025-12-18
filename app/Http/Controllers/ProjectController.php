<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
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
        return view('project.create');
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

        $project              = new Project();
        $project->user_id     = Auth::id();
        $project->name        = $request->name;
        $project->description = $request->description;

        $project->save();
        return redirect()->route('dashboard')->with('success', 'New Project Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        $todo_tasks = Task::where('project_id',$project->id)->where('status','todo')->get();
        $inprogress_tasks = Task::where('project_id',$project->id)->where('status','inprogress')->get();
        $done_tasks = Task::where('project_id',$project->id)->where('status','done')->get();
        return view('project.show',compact('project','todo_tasks','inprogress_tasks','done_tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project = Project::find($id);
        $project->name        = $request->name;
        $project->description = $request->description;
        $project->save();

        return redirect()->route('dashboard')->with('success', 'Project Updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('dashboard')->with('success', 'Project Deleted!');
    }
}
