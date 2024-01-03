<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Inertia\Inertia;
use App\Models\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
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

        return Redirect::back()->with('message', 'Page created.');
    }
}