<?php

namespace App\Repository\Eloquent;
use App\Models\Answer;
use App\Repository\AnswerRepository;
use Illuminate\Http\Request;

class EloquentAnswerRepository implements AnswerRepository
{

    /**
     * @param Request $request
     * @return Answer
     */
    public function createAnswer(Request $request)
    {
        $answer = new Answer();
        $answer->text = $request->text;
        $answer->question_id = $request->question_id;
        $answer->correct = $request->correct ? true : false;
        $answer->save();

        return $answer;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAnswers()
    {
        return Answer::select('id','question_id', 'text', 'correct', 'created_at', 'updated_at')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getAnswerById($id)
    {
        return Answer::select('id','question_id', 'text', 'correct', 'created_at', 'updated_at')->find($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Answer|Answer[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateAnswer(Request $request, $id)
    {
        $answer = Answer::find($id);
        if ($answer != null) {
            $answer->update([
                'question_id' => $request->question_id,
                'text' => $request->text,
                'correct' => $request->correct
                ]);

            return $answer;
        }

        return null;
    }

    /**
     * @param Answer $answer
     */
    public function deleteAnswer(Answer $answer)
    {
        $answer->delete();
    }
}
