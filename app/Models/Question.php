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

    public static function getQuestion(int $id)
    {
        $question = Question::find($id);

        if ($question->linked_question != null) {
            $linked_question = Question::find($question->linked_question);
            $questions = [$question, $linked_question];
            return $questions;
        }
        return $question;
    }


}
