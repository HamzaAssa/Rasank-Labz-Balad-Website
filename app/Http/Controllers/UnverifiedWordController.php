<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\WordToWord;
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
        $data = Word::whereNot('status', 2)->get();
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
            $word = new Word();
            $word->word = $request->word;
            $word->language = $request->language;
            $word->status = 0;
            $word->save();
        });

        return redirect()->back()->with('success', 'Word added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word  $Word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $Word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Word  $Word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $Word)
    {
        //
    }

    /**
     * addMeaning the specified resource in storage.
     *
     * @param  \App\Models\Word  $Word
     * @return \Illuminate\Http\Response
     */
    public function addMeaning(Request $request)
    {
        DB::transaction(function() use($request){
            $otherRelations = WordToWord::where('id', '!=', $request->id)
            ->where(function($query) use ($request) {
                $query->orWhere('balochi_id', $request->balochi_id)
                      ->orWhere('urdu_id', $request->urdu_id)
                      ->orWhere('english_id', $request->english_id)
                      ->orWhere('roman_balochi_id', $request->roman_balochi_id);
            })
            ->first();
        
            if($otherRelations != null) {
                if($otherRelations->balochi_id != 1 && $request->balochi_id == 1) {
                    $request->balochi_id = $otherRelations->balochi_id;
                }
                if($otherRelations->urdu_id != 2 && $request->urdu_id == 2) {
                    $request->urdu_id = $otherRelations->urdu_id;
                }
                if($otherRelations->english_id != 3 && $request->english_id == 3) {
                    $request->english_id = $otherRelations->english_id;
                }
                if($otherRelations->roman_balochi_id != 4 && $request->roman_balochi_id == 4) {
                    $request->roman_balochi_id = $otherRelations->roman_balochi_id;
                }

                $otherRelations->delete();
            }

            $wordRelation = WordToWord::find($request->id);

            $newRelation = new WordToWord();

            if($wordRelation->balochi_id != 1 && $request->balochi_id == 1) {
                $newRelation->balochi_id = $wordRelation->balochi_id;
            }
            if($wordRelation->urdu_id != 2 && $request->urdu_id == 2) {
                $newRelation->urdu_id = $wordRelation->urdu_id;
            }
            if($wordRelation->english_id != 3 && $request->english_id == 3) {
                $newRelation->english_id = $wordRelation->english_id;
            }
            if($wordRelation->roman_balochi_id != 4 && $request->roman_balochi_id == 4) {
                $newRelation->roman_balochi_id = $wordRelation->roman_balochi_id;
            }
            if(($wordRelation->balochi_id != 1 && $request->balochi_id == 1 ) 
            || ($wordRelation->urdu_id != 2 && $request->urdu_id == 2 ) 
            || ($wordRelation->english_id != 3 && $request->english_id == 3 ) 
            || ($wordRelation->roman_balochi_id != 4 && $request->roman_balochi_id == 4)) {
                $newRelation->date = date('Y-m-d');
                $newRelation->save();
            }

            $wordRelation->balochi_id = $request->balochi_id;
            $wordRelation->urdu_id = $request->urdu_id;
            $wordRelation->english_id = $request->english_id;
            $wordRelation->roman_balochi_id = $request->roman_balochi_id;
            $wordRelation->date = $request->date;
            $wordRelation->save();

        });
        return redirect()->back()->with('success', 'Meaning added successfully!');
    }
    /**
     * verify the specified resource in storage.
     *
     * @param  \App\Models\Word  $Word
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        DB::transaction(function() use($request){
            $word = Word::find($request->id);
            $word->status = 2;
            $word->save();
        });
        return redirect()->back()->with('success', 'Word updated successfully!');
    }
    /**
     * addPending the specified resource in storage.
     *
     * @param  \App\Models\Word  $Word
     * @return \Illuminate\Http\Response
     */
    public function addPending(Request $request)
    {
        DB::transaction(function() use($request){
            $word = Word::find($request->id);
            $word->status = 1;
            $word->save();

            $wordRelation = new WordToWord();
            $wordRelation->balochi_id = 1;
            $wordRelation->urdu_id = 2;
            $wordRelation->english_id = 3;
            $wordRelation->roman_balochi_id = 4;
            if($word->language == "BL") {
                $wordRelation->balochi_id = $word->id;
            }else if($word->language == "UR") {
                $wordRelation->urdu_id = $word->id;
            }else if($word->language == "EN") {
                $wordRelation->english_id = $word->id;
            }else if($word->language == "RB") {
                $wordRelation->roman_balochi_id = $word->id;
            }
            $wordRelation->date = date('Y-m-d');
            $wordRelation->save();
        });
        return redirect()->back()->with('success', 'Word updated successfully!');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Word  $Word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::transaction(function() use($request){
            $word = Word::find($request->id);
            $word->word = $request->word;
            $word->language = $request->language;
            $word->save();
        });
        return redirect()->back()->with('success', 'Word updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word  $Word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::transaction(function() use($request){
            $word = Word::with('definitions')->find($request->id);
            foreach ($word->definitions as $definition) {
                foreach ($definition->examples  as $example) {
                    $example->delete();
                }
                $definition->delete();
            }
            if($word->status == 1) {
                $relation = null;
                if($word->language == "BL") {
                    $relation = WordToWord::where('balochi_id', $word->id);
                }else if($word->language == "EN") { 
                    $relation = WordToWord::where('english_id', $word->id);
                }else if($word->language == "UR") { 
                    $relation = WordToWord::where('urdu_id', $word->id);
                }else if($word->language == "RB") { 
                    $relation = WordToWord::where('roman_balochi_id', $word->id);
                }
                if($relation != null) {
                    $relation->delete();
                }
            }
            $word->delete();
        });
        return redirect()->back()->with('danger', 'Word deleted successfully!');
    }
}
