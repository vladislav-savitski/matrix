<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class QuestionRepository implements RepositoriesInterface
{

    public $model;

    public function __construct(QuestionModel $model)
    {
        $this->model = $model;
    }

    public function get($id)
    {

        $this->model->find($id);
        // TODO: Implement get() method.
    }
}
