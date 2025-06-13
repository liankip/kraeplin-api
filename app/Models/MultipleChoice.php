<?php

namespace App\Models;

use App\Traits\HasQueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MultipleChoice extends Model
{
    use SoftDeletes, HasQueryFilter;

    protected $fillable = ['name', 'duration', 'notes', 'status'];
}
