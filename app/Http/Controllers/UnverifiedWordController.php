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
        $data = Word::where('status', '<', 2)->get();
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
            
            $wordRelation = WordToWord::find($request->id);

            // Remove all previous relations
                if($wordRelation->balochi_id == 1 && $request->balochi_id != 1) {
                    $balochiRelation = WordToWord::where('balochi_id', $request->balochi_id)->where('status', 0)->where('id', '!=', $request->id)->get();
                    foreach ($balochiRelation as $row) {
                        $row->balochi_id = 1;
                        $row->save();
                    }
                }
                if($wordRelation->urdu_id == 2 && $request->urdu_id != 2) {
                    $urduRelation = WordToWord::where('urdu_id', $request->urdu_id)
                    ->where('status', 0)->where('id', '!=', $request->id)->get();
                    foreach ($urduRelation as $row) {
                        $row->urdu_id = 2;
                        $row->save();
                    }                    
                }
                if($wordRelation->english_id == 3 && $request->english_id != 3) {
                    $englishRelation = WordToWord::where('english_id', $request->english_id)
                    ->where('status', 0)->where('id', '!=', $request->id)->get();
                    foreach ($englishRelation as $row) {
                        $row->english_id = 3;
                        $row->save();
                    }
                }
                if($wordRelation->roman_balochi_id == 4 && $request->roman_balochi_id != 4) {
                    $romanBalochiRelation = WordToWord::where('roman_balochi_id', $request->roman_balochi_id)
                    ->where('status', 0)->where('id', '!=', $request->id)->get();
                    foreach ($romanBalochiRelation as $row) {
                        $row->roman_balochi_id = 4;
                        $row->save();
                    }
                }




            // Add new relations if being removed
            if($wordRelation->balochi_id != 1 && $request->balochi_id == 1) {
                $balochiRelation = new WordToWord();
                $balochiRelation->balochi_id = $wordRelation->balochi_id;
                $balochiRelation->date = $request->date;
                $balochiRelation->save();
            }
            if($wordRelation->urdu_id != 2 && $request->urdu_id == 2) {
                $urduRelation = new WordToWord();
                $urduRelation->urdu_id = $wordRelation->urdu_id;
                $urduRelation->date = $request->date;
                $urduRelation->save();
            }
            if($wordRelation->english_id != 3 && $request->english_id == 3) {
                $englishRelation = new WordToWord();
                $englishRelation->english_id = $wordRelation->english_id;
                $englishRelation->date = $request->date;
                $englishRelation->save();
            }
            if($wordRelation->roman_balochi_id != 4 && $request->roman_balochi_id == 4) {
                $romanBalochiRelation = new WordToWord();
                $romanBalochiRelation->roman_balochi_id = $wordRelation->roman_balochi_id;
                $romanBalochiRelation->date = $request->date;
                $romanBalochiRelation->save();
            }

            // Update the current relation
            $wordRelation->balochi_id = $request->balochi_id;
            $wordRelation->urdu_id = $request->urdu_id;
            $wordRelation->english_id = $request->english_id;
            $wordRelation->roman_balochi_id = $request->roman_balochi_id;
            $wordRelation->date = $request->date;
            $wordRelation->save();

            // Delete all empty relations
           static::deleteAllEmptyRelations();

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

            $relation = $word->relation();
            $relation->status = 1;
            $relation->save();

            $balochiRelation = Word::find($relation->balochi_id);
            $balochiRelation->status = 2;
            $balochiRelation->save();

            $urduRelation = Word::find($relation->urdu_id);
            $urduRelation->status = 2;
            $urduRelation->save();

            $englishRelation = Word::find($relation->english_id);
            $englishRelation->status = 2;
            $englishRelation->save();

            $romanBalochiRelation = Word::find($relation->roman_balochi_id);
            $romanBalochiRelation->status = 2;
            $romanBalochiRelation->save();
        });
        return redirect()->back()->with('success', "Word Verified along with it's meanings successfully!");
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
                    $relation = WordToWord::where('balochi_id', $word->id)->where('status', 0)->first();
                    $relation->balochi_id = 1;
                    $relation->save();
                }else if($word->language == "UR") { 
                    $relation = WordToWord::where('urdu_id', $word->id)->where('status', 0)->first();
                    $relation->urdu_id = 2;
                    $relation->save();
                }else if($word->language == "EN") { 
                    $relation = WordToWord::where('english_id', $word->id)->where('status', 0)->first();
                    $relation->english_id = 3;
                    $relation->save();
                }else if($word->language == "RB") { 
                    $relation = WordToWord::where('roman_balochi_id', $word->id)->where('status', 0)->first();
                    $relation->roman_balochi_id = 4;
                    $relation->save();
                }
                static::deleteAllEmptyRelations();
            }
            $word->delete();
        });
        return redirect()->back()->with('danger', 'Word deleted successfully!');
    }

    static public function deleteAllEmptyRelations() {
        $allEmptyRelation = WordToWord::where('balochi_id', 1)
        ->where('urdu_id', 2)
        ->where('english_id', 3)
        ->where('roman_balochi_id', 4)
        ->where('status', 0)->get();

        foreach ($allEmptyRelation as $row) {
            $row->delete();
        }
    }
}
