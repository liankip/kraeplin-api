<?php

namespace App\Models;

use App\Traits\HasQueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    use HasApiTokens, HasRoles, HasQueryFilter;

    protected $fillable = ['id_group', 'username', 'password', 'nisn', 'name'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_group', 'id');
    }

    public function kraeplinSchedules()
    {
        return $this->hasManyThrough(
            KraeplinSchedule::class,
            KraeplinScheduleGroup::class,
            'id_group',
            'id',
            'id_group',
            'id_kraeplin_schedule'
        );
    }

}
