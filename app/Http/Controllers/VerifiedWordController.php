<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VerifiedWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Word::where('status', 2)->where('id', '>', 4)->get();
        return view('pages.verified_words.index', ['data' => $data]);
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
