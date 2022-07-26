@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-inline" action="{{ url('answer') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group mb-2">
                <label for="answerText" class="sr-only">Answer text</label>
                <input type="text" class="form-control" name="text" id="questionText" placeholder="Answer text">
            </div>
            <select class="form-select mb-2" name="question_id" id="questionId" aria-label="Default select example">
                <option selected>Open this select menu</option>
                @foreach ($questions as $question)
                    <option value="{{$question->id}}">{{$question->text}}</option>
                @endforeach
            </select>
            <div class="form-row">
                <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="correct" name="correct">
                    <label class="form-check-label" for="correct">
                        It's correct
                    </label>
                </div>
            </div>
            </div>
            <button type="submit" class="btn btn-primary mb-2 my-sm-3">Create answer</button>
        </form>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        ID
                    </th>
                    <th scope="col">
                        Text
                    </th>
                    <th scope="col">
                        Question
                    </th>
                    <th scope="col">
                        Correct
                    </th>
                    <th scope="col">
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($answers as $answer)
                <tr>
                    <th scope="row">
                        <div>{{ $answer->id }}</div>
                    </th>
                    <td>
                        <div>{{ $answer->text }}</div>
                    </td>
                    <td>
                        <div>{{ $answer->question->text }} </div>
                    </td>
                    <td>
                        <div>{{ $answer->correct === 1 ? 'Yes' : 'No' }}</div>
                    </td>
                    <td>
                        <form action="{{ url('answers/' . $answer->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
