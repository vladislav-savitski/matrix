<?php

namespace App\Repository\Eloquent;
use App\Models\Topic;
use App\Repository\TopicRepository;
use Illuminate\Http\Request;

class EloquentTopicRepository implements TopicRepository
{

    /**
     * @param Request $request
     * @return Topic
     */
    public function createTopic(Request $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->save();

        return $topic;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getTopics()
    {
        return Topic::select('id', 'name', 'created_at', 'updated_at')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getTopicById($id)
    {
        return Topic::select('id', 'name', 'created_at', 'updated_at')->find($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Topic|Topic[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateTopic(Request $request, $id)
    {
        $topic = Topic::find($id);
        if ($topic != null) {
            $topic->update([
                'name' => $request->name
                ]);

            return $topic;
        }

        return null;
    }

    /**
     * @param Topic $topic
     */
    public function deleteTopic(Topic $topic)
    {
        $topic->delete();
    }
}
