<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Repository\Eloquent\EloquentQuestionRepository;
use App\Repository\Eloquent\EloquentTopicRepository;
use Illuminate\Http\Request;
use Validator;


class QuestionController extends Controller
{
    protected $eloquentQuestion;
    protected $eloquentTopic;

    public function __construct(EloquentQuestionRepository $eloquentQuestion, EloquentTopicRepository  $eloquentTopic) {
        $this->eloquentQuestion = $eloquentQuestion;
        $this->eloquentTopic = $eloquentTopic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->eloquentQuestion->getQuestions();
        $topics = $this->eloquentTopic->getTopics();
        return view('questions', [
            'questions' => $questions,
            'topics' => $topics
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
            return redirect('/questions')
                ->withInput()
                ->withErrors($validator);
        }

        $question = $this->eloquentQuestion->createQuestion($request);
        if (!empty($question)){
            return redirect('/questions');
        }

        return redirect('/questions', 404);
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
            return redirect('/questions')
                ->withInput()
                ->withErrors($validator);
        }

        $question = $this->eloquentQuestion->updateQuestion($request, $id);

        if ($question != null) {
            return redirect('/questions');
        }

        return redirect('/questions', 404);
    }

    /**
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Question $question)
    {
        $question->delete();
        return redirect('/questions');
    }
}
