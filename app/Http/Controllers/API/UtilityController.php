<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Definition;
use App\Models\Word;
use App\Models\WordToWord;
use App\Models\PublishLog;
use App\Models\Example;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
{
    public function download(Request $request)
    {
        $version = $request->query('version') + 1;

        $oldestPublishinglog = PublishLog::find($version);

        $response = [
            "text" => "No new words available.",
            "words" => [],
            "definitions" => [],
            "examples" => [],
            "wordRelations" => [],
            "newDBVersion" => $request->version,
        ];

        if(!empty($oldestPublishinglog)) {
            $lastPublishLog = PublishLog::latest('id')->first();

            $words = Word::select('id', 'word', 'language')->where('id', '>=', $oldestPublishinglog->start_id)->where('status', 3)->get();
            $wordRelations = WordToWord::select('id', 'balochi_id', 'urdu_id', 'english_id', "roman_balochi_id")->get();
            $definitions = Definition::select('id', 'definition', 'word_id')->get();
            $examples = Example::select('id', 'example', 'definition_id')->get();

            $response = [
                "text" => count($words)." new words downloaded.",
                "words" => $words,
                "definitions" => $definitions,
                "examples" => $examples,
                "wordRelations" => $wordRelations,
                "newDBVersion" => $lastPublishLog->id,
            ];
        }

        return response()->json($response);
    }

    
    public function upload(Request $request)
    {
        $words = $request->input('words');
        $wordRelations = $request->input('relations');

        DB::transaction(function() use($request, &$words, &$wordRelations){
            foreach ($words as $row) {
                $word = new Word();
                $word->word = $row["word"];
                $word->language = $row["language"];
                $word->status = 0;
                $word->save();
            }
        });

        $response = count($words)." new words uploaded.";
        
        return response()->json($response);
    }
}
