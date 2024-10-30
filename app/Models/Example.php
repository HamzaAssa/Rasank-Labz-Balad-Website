<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Example;
use Illuminate\Database\Eloquent\SoftDeletes;

class Example extends Model
{
    use HasFactory;
    use SoftDeletes;

}
