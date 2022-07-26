<?php

namespace App\Repository\Eloquent;
use App\Models\Quiz;
use App\Repository\QuizRepository;
use Illuminate\Http\Request;

class EloquentQuizRepository implements QuizRepository
{

    /**
     * @param Request $request
     * @return Quiz
     */
    public function createQuiz(Request $request)
    {
        $quiz = new Quiz;
        $quiz->title = $request->title;
        $quiz->save();

        return $quiz;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getQuizzes()
    {
        return Quiz::all();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getQuizById($id)
    {
        return Quiz::select('id', 'title', 'created_at', 'updated_at')->find($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Quiz|Quiz[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateQuiz(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        if ($quiz != null) {
            $quiz->update([
                'title' => $request->title
            ]);

            return $quiz;
        }

        return null;
    }

    /**
     * @param Quiz $quiz
     */
    public function deleteQuiz(Quiz $quiz)
    {
        $quiz->delete();
    }

    public function addQuestion(Request $request)
    {
        Quiz::find($request->quiz_id)->questions()->attach($request->question_id);
    }

    public function viewQuestions($quiz_id)
    {
        return Quiz::find($quiz_id)->questions;
    }
}
