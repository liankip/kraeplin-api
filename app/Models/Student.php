<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasApiTokens;

    protected $fillable = ['id_group', 'username', 'password', 'nisn', 'name'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
