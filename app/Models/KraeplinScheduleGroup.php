<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KraeplinScheduleGroup extends Model
{
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
