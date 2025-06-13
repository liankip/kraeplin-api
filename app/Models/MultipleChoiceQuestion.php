<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MultipleChoiceQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'answer',
        'score'
    ];
}
