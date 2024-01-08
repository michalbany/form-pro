<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\TextField;
use Faker\Provider\ar_EG\Text;
use Illuminate\Support\Facades\Redirect;


class TextFieldController extends Controller
{
   
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

    public function update($id, Request $request)
    {

        $textField = TextField::find($id);

        $textField->update([
            'label' => $request->label,
            'content' => $request->content,
            'recommended_length' => $request->recommended_length
        ]);
        
        return Redirect::back()->with('message', 'Text field saved.');
    }

    public function destroy($id)
    {
        $textfield = TextField::find($id);

        $textfield->delete();

        return Redirect::back()->with('message', 'Text field deleted.');
    }

}
