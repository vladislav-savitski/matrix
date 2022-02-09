<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionPostRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Validator;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::with('question')->orderBy('created_at', 'asc')->get();
        $questions = Question::orderBy('created_at', 'asc')->get();
        return view(
            'answers',
            [
                'answers' => $answers,
                'questions' => $questions,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function create(QuestionPostRequest $request)
    {
        $validated = $request->validated();

        if (!$validated) {
            return redirect('/answers')
                ->withInput()
                ->withErrors($request);
        }

        Answer::create(
            [
                'text' => $request->post('text'),
                'question_id' => $request->post('question_id'),
                'correct' => $request->post('correct', false)
            ]
        );

        return redirect('/answers');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return redirect('/answers');
    }
}
