<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';

    public function options()
    {
        return $this->hasMany('App\Models\QuestionOption');
    }

    public static function getQuestion(int $level)
    {
        $question = Question::where("level", $level)->get();


        return $question;
    }


}
