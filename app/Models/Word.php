<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Definition;
use App\Models\WordToWord;

class Word extends Model
{
    use HasFactory, SoftDeletes;

    public function relation()
    {
        return WordToWord::where('balochi_id', $this->id)
        ->orWhere('urdu_id', $this->id)
        ->orWhere('english_id', $this->id)
        ->orWhere('roman_balochi_id', $this->id)->first();
    }

    public function definitions()
    {
        return $this->hasMany(Definition::class, 'word_id');
    }
    
    public function meanings()
    {
        $result = WordToWord::where('balochi_id', $this->id)
        ->orWhere('urdu_id', $this->id)
        ->orWhere('english_id', $this->id)
        ->orWhere('roman_balochi_id', $this->id)->first();
        $balochiWord = Word::find($result->balochi_id);
        $urduWord = Word::find($result->urdu_id);
        $englishWord = Word::find($result->english_id);
        $romanBalochiWord = Word::find($result->roman_balochi_id);
        return ["balochi" => $balochiWord, "urdu" => $urduWord, "english" => $englishWord, "romanBalochi" => $romanBalochiWord, 'relationId' => $result->id];
    }
    static public function balochiWords()
    {
        return self::where('language', 'BL')->where('status', '!=', 0)->get();
    }

    static public function urduWords()
    {
        return self::where('language', 'UR')->where('status', '!=', 0)->get();
    }

    static public function englishWords()
    {
        return self::where('language', 'EN')->where('status', '!=', 0)->get();
    }

    static public function romanBalochiWords()
    {
        return self::where('language', 'RB')->where('status', '!=', 0)->get();
    }
}
