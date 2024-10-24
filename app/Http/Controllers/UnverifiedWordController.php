<?php

namespace App\Http\Controllers;

use App\Models\UnverifiedWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UnverifiedWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UnverifiedWord::all();
        return view('pages.unverified_words.index', ['data' => $data]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use($request){
            $word = new UnverifiedWord();
            $word->word = $request->word;
            $word->language = $request->language;
            $word->save();
        });

        return redirect()->back()->with('success', 'Your action was successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnverifiedWord  $unverifiedWord
     * @return \Illuminate\Http\Response
     */
    public function show(UnverifiedWord $unverifiedWord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnverifiedWord  $unverifiedWord
     * @return \Illuminate\Http\Response
     */
    public function edit(UnverifiedWord $unverifiedWord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\UnverifiedWord  $unverifiedWord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnverifiedWord $unverifiedWord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnverifiedWord  $unverifiedWord
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnverifiedWord $unverifiedWord)
    {
        //
    }
}
