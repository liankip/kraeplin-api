<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KraeplinSchedule extends Model
{
    use SoftDeletes;

    protected $fillable = ['id_kraeplin', 'date'];

    public function kraeplin(): BelongsTo
    {
        return $this->belongsTo(Kraeplin::class, 'id_kraeplin');
    }
}
