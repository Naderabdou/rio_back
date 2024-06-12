<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

    //get translation question
    public function getQuestionAttribute()
    {
        return $this->attributes['question_' . app()->getLocale()];
    } // end getNameAttribute

    //get translation answer.

    public function getAnswerAttribute()
    {
        return $this->attributes['answer_' . app()->getLocale()];
    } // end getNameAttribute

}
