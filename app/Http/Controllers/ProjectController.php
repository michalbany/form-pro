<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return Inertia::render('Dashboard', ['projects' => $projects]);
    }

    public function destroy(Request $request, Project $project)
    {
        // Ověřte heslo uživatele
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        // Smazání projektu
        $project->delete();

        return Redirect::to('/dashboard');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Project/ProjectEdit', ['project' => $project]);
    }
}