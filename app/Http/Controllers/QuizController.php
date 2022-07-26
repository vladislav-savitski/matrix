<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Repository\Eloquent\EloquentQuizRepository;
use App\Repository\Eloquent\EloquentQuestionRepository;
use Illuminate\Http\Request;
use Validator;

class QuizController extends Controller
{
    protected $eloquentQuiz;
    protected $eloquentQuestion;

    public function __construct(EloquentQuizRepository $eloquentQuiz, EloquentQuestionRepository $eloquentQuestion) {
        $this->eloquentQuiz = $eloquentQuiz;
        $this->eloquentQuestion = $eloquentQuestion;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = $this->eloquentQuiz->getQuizzes();
        $questions = $this->eloquentQuestion->getQuestions();
        $quizzesQuestions = [];
        foreach ($quizzes as $quiz) {
            $quizzesQuestions[] = $this->eloquentQuiz->viewQuestions($quiz->id);
        }
        return view('quiz', [
            'quizzes' => $quizzes,
            'questions' => $questions,
            'quizzesQuestions' => $quizzesQuestions
        ]);
    }

    public function add_question(Request $request)
    {
        $this->eloquentQuiz->addQuestion($request);
        return redirect('/quizzes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/quizzes')
                ->withInput()
                ->withErrors($validator);
        }

        $quiz = $this->eloquentQuiz->createQuiz($request);
        if (!empty($quiz)){
            return redirect('/quizzes');
        }

        return redirect('/quizzes', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/quizzes')
                ->withInput()
                ->withErrors($validator);
        }

        $quiz = $this->eloquentQuiz->updateQuiz($request, $id);

        if ($quiz != null){
            return redirect('/quizzes');
        }

        return redirect('/quizzes', 404);
    }

    /**
     * @param Quiz $quiz
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Quiz $quiz)
    {
        $this->eloquentQuiz->deleteQuiz($quiz);
        return redirect('/quizzes');
    }
}
