<?php

namespace App\Models;

use App\Traits\HasQueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MultipleChoiceQuestion extends Model
{
    use SoftDeletes, HasQueryFilter;

    protected $fillable = [
        'id_multiple_choice',
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
