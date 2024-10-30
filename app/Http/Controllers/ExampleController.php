<?php

namespace App\Http\Controllers;

use App\Models\Example;
use App\Models\Definition;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $example = Example::where('definition_id', $id)->get();
        $definition = Definition::find($id);
        $word = Word::find($definition->word_id);
        return view('pages.example.index', ['data' => $example, 'word' => $word, 'definition' => $definition]);
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
            $example = new Example();
            $example->definition_id = $request->definition_id;
            $example->example = $request->example;
            $example->save();
        });
        return redirect()->back()->with('success', 'Example added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function show(Example $example)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function edit(Example $example)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Example $example)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::transaction(function() use($request){
            $example = Example::find($request->id);
            $example->delete();
        });
        return redirect()->back()->with('danger', 'Example deleted successfully!');
    }
}
