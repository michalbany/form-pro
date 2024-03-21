<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Mockery\Undefined;

class EditorService
{

    /**
     * Správa funkcionality editoru. Inicializace + správa akcí
     * 
     * 
     */

    /**
     * Inicializace editoru pro projekt
     * @param ini $project_id
     */
    public function init(Request $request, Project $project)
    {
        $pageId = $request->input('page');
        $page = null;

        if ($pageId) {
            $page = Page::find($pageId);
        }

        $initData = [
            'project' => [
                'id' => $project->id,
                'name' => $project->name,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ],
            'parentPages' => $this->loadParentPages($project)
        ];

        return Inertia::render('Editor/EditorGlobalSettings', [
            'initData' => $initData,
            'subpages' => $page ? Inertia::lazy(fn () => $this->loadSubpages($page)) : [],
    ]);
    }

    /**
     * Vrátí všechny rodičovské stránky projektu
     * @param Project $project
     * @return array|null
     */
    public function loadParentPages(Project $project)
    {
        $parentPages = $project->scopeParentPages;
        $data = [];
        foreach ($parentPages as $parentPage) {
            // asociativní pole s ID jako klíčem
            $data[$parentPage->id] = [
                'id' => $parentPage->id,
                'name' => $parentPage->name,
                'parent_id' => $parentPage->parent_id,
            ];
        }
        return $data;
    }

    /**
     * Vrátí všechny podstránky stránky
     * @param Page $page
     * @return array|null
     */
    public function loadSubpages(Page $page)
    {
        $subpages = $page->children;
        $data = [];
        
        foreach ($subpages as $subpage) {
            $data[$subpage->id] = [
                'id' => $subpage->id,
                'name' => $subpage->name,
                'parent_id' => $subpage->parent_id,
            ];
        }

        $finalData = [$page->id => $data];

        return $finalData;
    }

    /**
     * V Budoucnu...
     */
    public function canBeEdited()
    {
        //
    }

    public function test(Project $project, Page $page = null)
    {

        ddd($page);
        ddd($project);
    }
}
