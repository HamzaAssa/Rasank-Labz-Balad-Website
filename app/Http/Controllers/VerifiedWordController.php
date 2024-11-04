<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\PublishLog;
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
        $data = Word::where('status', '>', 1)->where('id', '>', 4)->get();
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
    /**
     * publish the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request)
    {
        $count = 0;
        $words = Word::where('status', 2)->get();
        if($words->isEmpty()) {
            return redirect()->back()->with('info', 'No available words to be published!');
        }
        DB::transaction(function() use($request, &$count){

            $first = Word::where('status', 2)->oldest('id')->first();
            $last = Word::where('status', 2)->latest('id')->first();
            
            $publishCount = Word::where('status', 2)->update(['status' => 3]);

            $lastPublishLog = PublishLog::latest('id')->first();
            $version = 1;
            if($lastPublishLog != null) {
                $version = $lastPublishLog->version;
            }

            $log =  new PublishLog();
            $log->start_id = $first->id;
            $log->last_id = $last->id;
            $log->count = $publishCount;
            $log->version = $version;
            $log->date = date('Y-m-d');
            $log->save();

            $count = $publishCount;
        });

        return redirect()->back()->with('success', $count.' words published successfully!');

    }
}
