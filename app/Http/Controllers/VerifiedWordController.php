<?php

namespace App\Http\Controllers;

use App\Models\VerifiedWord;
use Illuminate\Http\Request;

class VerifiedWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.verified_words.index');
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
     // Validate request data
        $validated = $request->validate([
            'word' => 'required|string',
            'language' => 'required|string',
        ]);
    
        // Save the data
        $words = new VerifiedWord();
        $words->word = $validated['word'];
        $words->language = $validated['language'];
        $words->save();
    
        return response()->json(['message' => 'Word saved successfully!', 'words' => $words], 201);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VerifiedWord  $verifiedWord
     * @return \Illuminate\Http\Response
     */
    public function show(VerifiedWord $verifiedWord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VerifiedWord  $verifiedWord
     * @return \Illuminate\Http\Response
     */
    public function edit(VerifiedWord $verifiedWord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VerifiedWord  $verifiedWord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VerifiedWord $verifiedWord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VerifiedWord  $verifiedWord
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerifiedWord $verifiedWord)
    {
        //
    }
}
