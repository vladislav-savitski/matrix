<?php
namespace App\Repository;

use App\Models\Question;
use Illuminate\Http\Request;

interface QuestionRepository
{
    public function createQuestion(Request $request);
    public function getQuestions();
    public function getQuestionById($id);
    public function updateQuestion(Request $request, $id);
    public function deleteQuestion(Question $question);
}
