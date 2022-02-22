<?php

namespace App\Repository;
use App\Models\Answer;
use Illuminate\Http\Request;
use Validator;

class EloquentAnswerRepository implements AnswerRepository
{


    public function createAnswer(Request $request)
    {
        $answer = new Answer();
        $answer->text = $request->text;
        $answer->question_id = $request->question_id;
        $answer->correct = $request->correct ? true : false;
        $answer->save();

        return $answer;
    }

    public function getAnswers()
    {
        return Answer::select('id','question_id', 'text', 'correct', 'created_at', 'updated_at')->get();
    }

    public function getAnswerById($id)
    {
        return Answer::select('id','question_id', 'text', 'correct', 'created_at', 'updated_at')->find($id);
    }

    public function updateAnswer(Request $request, $id)
    {
        // TODO: Implement updateAnswer() method.
    }
}
