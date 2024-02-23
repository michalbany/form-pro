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

    /**
     * Zobrazení všech projektů na dashboardu
     * @return \Inertia\Response
     */
    public function index()
    {
        $projects = Project::all();
        return Inertia::render('Dashboard', ['projects' => $projects]);
    }

    /**
     * Tato metoda slouží pro základní data projektu při jeho natčení do editoru
     * @return Data projektu + hierarchie stránek pro Inertia view
     */
    public function show(Project $project)
    {
        // Načtení stránek projektu, pokud již nejsou načteny
        $project->load('pages');
        $pages = collect($project->pages);

        // Definice rekurzivní funkce pro sestavení hierarchie stránek a jejich podstránek
        $buildPagesHierarchy = function ($pages, $parentId = null) use (&$buildPagesHierarchy) {
            return $pages->filter(function ($page) use ($parentId) {
                return $page->parent_id == $parentId;
            })->map(function ($page) use ($pages, &$buildPagesHierarchy) {
                // Rekurzivní sestavení hierarchie pro podstránky
                $children = $buildPagesHierarchy($pages, $page->id);
                return [
                    'id' => $page->id,
                    'name' => $page->name,
                    'parent_id' => $page->parent_id,
                    'children' => $children,
                ];
            });
        };

        // Použití rekurzivní funkce pro sestavení hierarchie stránek
        $pagesHierarchy = $buildPagesHierarchy($pages);

        // Příprava dat projektu pro předání do view nebo jako JSON pro použití ve frontendu
        $projectData = [
            'id' => $project->id,
            'name' => $project->name,
            'pages' => $pagesHierarchy,
        ];
        // Vrácení dat do Inertia view
        return Inertia::render('Project/Editor', $projectData);
    }


    /**
     * Vytvoření nového projektu a následné přesměrování na jeho editaci
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Smazání projektu a všech jeho stránek
     * @todo: Možná můžeme zoptimalizovat
     */
    public function destroy(Request $request, Project $project)
    {
        // Ověřte heslo uživatele
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        // nejprve smažeme všechny stránky a podstránky
        foreach ($project->pages as $page) {
            $this->deletePageAndChildren($page);
        }

        // Smazání projektu
        $project->delete();

        return Redirect::to('/dashboard');
    }
    
    protected function deletePageAndChildren($page)
    {
        // rekurzivně projdeme všechny postránky a jejich textová pole a smažeme je
        foreach ($page->textFields as $textField) {
            $textField->delete();
        }
        
        foreach ($page->children as $child) {
            $this->deletePageAndChildren($child);
        }
        
        $page->delete();
    }
    
    
    /** @change: Pro refaktorizaci upravujeme logiku zobrazení projektu
     * Projekt využijeme jinou metodu a budeme načítat data odděleně od stránek
     */

    
     
     




    
    // REFACTOR THIS
    /**
     * @note: Tato metoda slouží pouze pro otevření editoru projektu
     * @remove: after refactoring
     */

    public function edit(Project $project) // @change
    {
        // Načtení projektu spolu se všemi jeho stránkami
        $projectWithPages = Project::with('pages')->findOrFail($project->id);
        
        // a všemi textovými poli
        foreach ($projectWithPages->pages as $page) {
            $page->textfields = $page->textfields;
        }

        return Inertia::render('Project/ProjectEdit', [
            'project' => $projectWithPages,
            'pages' => $projectWithPages->pages, // @remove: Toto je dumplicita, stejné data jsou již v $project
            
        ]);
    }

    /**
     * @note: Tato metoda slouží k editaci hodnot projektu
     * @review: Pro refaktorizaci upravujeme logiku editace projektu
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