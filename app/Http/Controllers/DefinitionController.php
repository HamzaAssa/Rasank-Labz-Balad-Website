<?php

namespace App\Http\Controllers;

use App\Models\Definition;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Definition::where('word_id', $id)->get();
        $word = Word::find($id);
        return view('pages.definition.index', ['data' => $data, 'word' => $word]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use($request){
            $definition = new Definition();
            $definition->word_id = $request->word_id;
            $definition->definition = $request->definition;
            $definition->save();
        });
        return redirect()->back()->with('success', 'Definition added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Definition  $definition
     * @return \Illuminate\Http\Response
     */
    public function show(Definition $definition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Definition  $definition
     * @return \Illuminate\Http\Response
     */
    public function edit(Definition $definition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Definition  $definition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Definition $definition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Definition  $definition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::transaction(function() use($request){
            $definition = Definition::with('examples')->find($request->id);
            foreach ($definition->examples  as $example) {
                $example->delete();
            }
            $definition->delete();
        });
        return redirect()->back()->with('danger', 'Definition deleted successfully!');
    }
}
