<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WordToWord extends Model
{
    use HasFactory, SoftDeletes;

    public function balochiWord()
    {
        return $this->belongsTo(Word::class, 'balochi_id');
    }

    public function urduWord()
    {
        return $this->belongsTo(Word::class, 'urdu_id');
    }

    public function englishWord()
    {
        return $this->belongsTo(Word::class, 'english_id');
    }

    public function romanBalochiWord()
    {
        return $this->belongsTo(Word::class, 'roman_balochi_id');
    }
}
