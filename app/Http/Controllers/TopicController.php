<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Repository\Eloquent\EloquentTopicRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class TopicController extends Controller
{
    protected $eloquentTopic;

    public function __construct(EloquentTopicRepository $eloquentTopic) {
        $this->eloquentTopic = $eloquentTopic;
    }

    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index()
    {
        $topics = $this->eloquentTopic->getTopics();

        return view('topics', ['topics' => $topics]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/topics')
                ->withInput()
                ->withErrors($validator);
        }

        $topic = $this->eloquentTopic->createTopic($request);
        if (!empty($topic)){
            return redirect('/topics');
        }

        return redirect('/topics', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/topics')
                ->withInput()
                ->withErrors($validator);
        }

        $topic = $this->eloquentTopic->updateTopic($request, $id);

        if ($topic != null){
            return redirect('/topics');
        }

        return redirect('/topics', 404);
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Topic $topic)
    {
        $topic->delete();
        return redirect('/topics');
    }
}
