<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = "exams";
    protected $fillable = ['exam_type_id','pm','fm','semester','duration','date','subject_id'];
}
