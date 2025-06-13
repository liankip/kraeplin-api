<?php

namespace App\Models;

use App\Traits\HasQueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes, HasQueryFilter;

    protected $fillable = ['name'];

    public function kraeplinScheduleGroup(): HasMany
    {
        return $this->hasMany(KraeplinScheduleGroup::class, 'id_group');
    }
}
