<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kraeplin extends Model
{
    protected $fillable = ['name', 'duration', 'status', 'description'];
}
