<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Project;
use Inertia\Inertia;

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
    public function init(Project $project)
    {
        $data = [
            'project' => [
                'id' => $project->id,
                'name' => $project->name,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ],
            'parentPages' => $this->loadParentPages($project)
        ];

        return Inertia::render('Editor/EditorGlobalSettings', $data);
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
            $data[] = [
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
            $data[] = [
                'id' => $subpage->id,
                'name' => $subpage->name,
                'parent_id' => $subpage->parent_id,
            ];
        }

        return $data;
    }

    /**
     * V Budoucnu...
     */
    public function canBeEdited()
    {
        //
    }

    public function test(Project $project)
    {
        ddd($project);
    }
}
