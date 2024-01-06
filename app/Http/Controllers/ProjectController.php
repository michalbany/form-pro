<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use App\Models\Page;
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

    public function create() {
        // vytvoření nového projektu
        $project = Project::create([
            'name' => 'New project'
        ]);

        // vytvoření první stránky
        $page = new Page();
        $page->project_id = $project->id;
        $page->name = 'Home';
        $page->save();

        return Redirect::to('/projects/' . $project->id . '/edit');

    }

    public function destroy(Request $request, Project $project)
    {
        // Ověřte heslo uživatele
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        // nejprve smažeme všechny stránky
        foreach ($project->pages as $page) {
            $page->delete();
        }

        // Smazání projektu
        $project->delete();

        return Redirect::to('/dashboard');
    }

    /**
     * @note: Tato metoda slouží pouze pro otevření editoru projektu
     */

    public function edit(Project $project)
    {
        // Načtení projektu spolu se všemi jeho stránkami
        $projectWithPages = Project::with('pages')->findOrFail($project->id);

        return Inertia::render('Project/ProjectEdit', [
            'project' => $projectWithPages,
            'pages' => $projectWithPages->pages
        ]);
    }

    /**
     * @note: Tato metoda slouží k editaci hodnot projektu
     */
    public function update(Request $request, Project $project)
    {
        // @note: mohli bychom používat Requests pro validaci dat, ale vzhledem k tomu, že se jedná o jednoduchou aplikaci, tak to necháme takto
        $validateData = $request->validate([
            'name' => 'required|max:255',
            // další pravidla v budoucnu
        ]);
        // sanitace dat
        //$validateData['name'] = htmlspecialchars($validateData['name']);

        //sanitace proti sql injection
        //$validateData['name'] = str_replace("'", "", $validateData['name']);

        $project->update($validateData);

        return Redirect::back()->with('message', 'Project saved.');

    }


}