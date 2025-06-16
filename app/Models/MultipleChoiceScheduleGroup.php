<?php

namespace App\Models;

use App\Traits\HasQueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MultipleChoiceScheduleGroup extends Model
{
    use softDeletes, HasQueryFilter;

    protected $fillable = [
        'id_group',
        'id_multiple_choice_schedule',
    ];
}
