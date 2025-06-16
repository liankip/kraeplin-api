<?php

namespace App\Models;

use App\Traits\HasQueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MultipleChoiceScheduler extends Model
{
    use SoftDeletes, HasQueryFilter;

    protected $fillable = ['id_multiple_choice', 'date'];
}
