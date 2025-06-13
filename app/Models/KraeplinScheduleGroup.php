<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KraeplinScheduleGroup extends Model
{
    use SoftDeletes;

    protected $fillable = ['id_group', 'id_kraeplin_schedule'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_group');
    }

    public function kraeplinSchedule(): BelongsTo
    {
        return $this->belongsTo(KraeplinSchedule::class, 'id_kraeplin_schedule');
    }
}
