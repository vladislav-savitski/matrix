<?php

namespace App\Repository\Eloquent;
use App\Models\Question;
use App\Repository\QuestionRepository;
use Illuminate\Http\Request;

class EloquentQuestionRepository implements QuestionRepository
{

    /**
     * @param Request $request
     * @return Question
     */
    public function createQuestion(Request $request)
    {
        $question = new Question;
        $question->text = $request->text;
        $question->topic_id = $request->topic_id;
        $question->save();

        return $question;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getQuestions()
    {
        return Question::select('id','topic_id', 'text', 'created_at', 'updated_at')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getQuestionById($id)
    {
        return Question::select('id','topic_id', 'text', 'created_at', 'updated_at')->find($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Question|Question[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateQuestion(Request $request, $id)
    {
        $question = Question::find($id);
        if ($question != null) {
            $question->update([
                'topic_id' => $request->topic_id,
                'text' => $request->text
            ]);

            return $question;
        }

        return null;
    }

    /**
     * @param Question $question
     */
    public function deleteQuestion(Question $question)
    {
        $question->delete();
    }
}
