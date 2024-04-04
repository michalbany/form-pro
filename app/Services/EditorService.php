<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EditorService
{

    /**
     * Správa funkcionality editoru. Inicializace + správa akcí
     * 
     * Renderovat stránku musí vždy ta metoda, která je volana z web.php
     * 
     */

    /**
     * Show na route project
     * @param $request
     * @param $project
     * @return Inertia::render
     */
    public function show(Request $request, Project $project) {
        
        $pageFromRequest = $this->getPageFromRequest($request);
        $initData = $this->init($project);


        return Inertia::render('Editor/EditorGlobalSettings', [
            'initData' => $initData,
            'subpages' => $pageFromRequest ? $this->loadSubpages($pageFromRequest) : [],
        ]);
    }

    /**
     * Show na route page
     * @param $request -> kvůli načítání subpages na url page
     * @param $project
     * @param $page
     * @return Inertia::render
     */
    public function showPage(Request $request, Project $project, Page $page)
    {
        $pageFromRequest = $this->getPageFromRequest($request);

        $pageData = [
            'page' => [
                'id' => $page->id,
                'name' => $page->name,
                'content' => $page->content,
                'created_at' => $page->created_at,
                'updated_at' => $page->updated_at,
            ],
            'content' => $page->content,
        ];

        $initData = $this->init($project);

        return Inertia::render('Editor/EditorGlobalSettings', [
            'initData' => $initData,
            'pageData' => $pageData,
            'subpages' => $pageFromRequest ? $this->loadSubpages($pageFromRequest) : [],


        ]);
    }

    /**
     * Inicializace editoru pro projekt
     * @param ini $project_id
     */
    public function init(Project $project)
    {
        $initData = [
            'project' => [
                'id' => $project->id,
                'name' => $project->name,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ],
            'parentPages' => $this->loadParentPages($project)
        ];

        return $initData;
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
     * V Budoucnu...myšleno projekt
     */
    public function canBeEdited()
    {
        //
    }

    private function getPageFromRequest(Request $request)
    {
        $pageId = $request->input('pageId');
        $page = null;

        if ($pageId) {
            $page = Page::find($pageId);
        }

        return $page;
    }

    /**
     * Testovací metoda
     */
    public function test(Project $project, Page $page = null)
    {

        ddd($page);
        ddd($project);
    }
}
