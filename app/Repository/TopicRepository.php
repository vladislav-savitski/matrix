<?php
namespace App\Repository;

use App\Models\Topic;
use Illuminate\Http\Request;

interface TopicRepository
{
    public function createTopic(Request $request);
    public function getTopics();
    public function getTopicById($id);
    public function updateTopic(Request $request, $id);
    public function deleteTopic(Topic $topic);
}
