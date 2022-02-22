<?php
namespace App\Repository;

use App\Models\Answer;
use Illuminate\Http\Request;

interface AnswerRepository
{
    public function createAnswer(Request $request);
    public function getAnswers();
    public function getAnswerById($id);
    public function updateAnswer(Request $request, $id);
}
