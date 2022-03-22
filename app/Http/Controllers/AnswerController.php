<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Repository\Eloquent\EloquentAnswerRepository;
use App\Repository\Eloquent\EloquentQuestionRepository;
use Illuminate\Http\Request;
use Validator;

class AnswerController extends Controller
{
    protected $eloquentAnswer;
    protected $eloquentQuestion;

    public function __construct(EloquentAnswerRepository $eloquentAnswer, EloquentQuestionRepository $eloquentQuestion) {
        $this->eloquentAnswer = $eloquentAnswer;
        $this->eloquentQuestion = $eloquentQuestion;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $answers = $this->eloquentAnswer->getAnswers();
        $questions = $this->eloquentQuestion->getQuestions();
        return view('answers', [
            'answers' => $answers,
            'questions' => $questions,
        ]);
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
            'text' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/answers')
                ->withInput()
                ->withErrors($validator);
        }

        $answer = $this->eloquentAnswer->createAnswer($request);
        if (!empty($answer)){
            return redirect('/answers');
        }

        return redirect('/answers', 404);
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
            'text' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/answers')
                ->withInput()
                ->withErrors($validator);
        }

        $answer = $this->eloquentAnswer->updateAnswer($request, $id);

        if ($answer != null){
            return redirect('/answers');
        }

        return redirect('/answers', 404);
    }

    /**
     * @param Answer $answer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Answer $answer)
    {
        $this->eloquentAnswer->deleteAnswer($answer);
        return redirect('/answers');
    }
}
