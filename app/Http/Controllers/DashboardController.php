<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $projects = Project::where('user_id',Auth::id())->get();
        return view('dashboard',compact('projects'));
    }
}
