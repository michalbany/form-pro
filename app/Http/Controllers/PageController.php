<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Inertia\Inertia;
use App\Models\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    // public function getNewPage($projectId, $pageId)
    // {
    //     $page = Page::where('id', $pageId)
    //         ->where('project_id', $projectId)
    //         ->first();
        
    //     return Inertia::render('Project/ProjectEdit', [
    //         'page' => $page
    //     ]);
    // }


    public function update(Request $request, Page $page)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // další pravidla v budoucnu..
        ]);

        // sanitace dat..

        $page->update($validatedData);

        return Redirect::back()->with('message', 'Page saved.');
    }

    // funkce pro vytvoření nové stránky
    public function create(Request $request)
    {
        $page = new Page();
        $page->project_id = $request->projectId;
        $page->parent_id = $request->parentPageId ?? null;
        $page->name = $request->name;
        $page->save();

        $pages = Page::where('project_id', $request->projectId)
            ->get();

        // return redirect()->route('pages.newpage', ['projectId' => $request->projectId, 'pageId' => $page->id]);
    
        // return Redirect::back()->with(['pages' => $pages, 'page' => $page]);

        return Redirect::back()->with('message', 'Page created.');

        // return Redirect::route('pages.newpage', ['projectId' => $request->projectId, 'pageId' => $page->id]);
    }
}
