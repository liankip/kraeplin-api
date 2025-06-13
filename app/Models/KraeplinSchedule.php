<?php

namespace App\Models;

use App\Traits\HasQueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KraeplinSchedule extends Model
{
    use SoftDeletes, HasQueryFilter;

    protected $hidden = ['laravel_through_key'];

    protected $fillable = ['id_kraeplin', 'date'];

    public function kraeplin(): BelongsTo
    {
        return $this->belongsTo(Kraeplin::class, 'id_kraeplin');
    }
}
