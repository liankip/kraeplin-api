<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentKraeplinTest extends Model
{
    protected $fillable = ['id_student', 'id_kraeplin_schedule', 'start', 'finish', 'right_count', 'false_count', 'status'];
}
