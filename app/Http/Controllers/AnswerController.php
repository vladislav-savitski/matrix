<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Repository\EloquentAnswerRepository;
use Illuminate\Http\Request;
use Validator;

class AnswerController extends Controller
{
    protected $eloquentAnswer;

    public function __construct(EloquentAnswerRepository $eloquentAnswer) {
        $this->eloquentAnswer = $eloquentAnswer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $answers = $this->eloquentAnswer->getAnswers();
        $questions = Question::orderBy('created_at', 'asc')->get();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Answer $answer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return redirect('/answers');
    }
}
