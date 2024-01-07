<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\TextField;
use Illuminate\Support\Facades\Redirect;


class TextFieldController extends Controller
{
   
    // @note: Pravděpodobně nebudeme potřebovat Page $page
    public function create(Request $request)
    {
        $field = TextField::create([
            'page_id' => $request->page_id,
            'label' => $request->label,
            'content' => $request->content,
            'recommended_length' => $request->recommended_length
        ]);

        return Redirect::back()->with('message', 'Text field created.');
    }

    public function update(Request $request, Page $page)
    {
        //
    }

    public function destroy(Request $request,)
    {
        //
    }

    // @todo: Při mazání stránek, podstránek a projektů je nutné smazat i všechny textové pole
}
