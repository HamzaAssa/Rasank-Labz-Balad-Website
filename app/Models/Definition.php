<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Example;
use App\Models\Word;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definition extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function examples()
    {
        return $this->HasMany(Example::class, 'definition_id');
    }
}
