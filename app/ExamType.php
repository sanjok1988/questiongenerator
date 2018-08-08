<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $table = "exams_types";
    protected $fillable = ['name','notice'];
}
