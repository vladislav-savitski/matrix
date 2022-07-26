<?php
namespace App\Repository;

use App\Models\Quiz;
use Illuminate\Http\Request;

interface QuizRepository
{
    public function createQuiz(Request $request);
    public function getQuizzes();
    public function getQuizById($id);
    public function updateQuiz(Request $request, $id);
    public function deleteQuiz(Quiz $quiz);
    public function addQuestion(Request $request);
    public function viewQuestions($quiz_id);
}
