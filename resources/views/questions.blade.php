@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-inline" action="{{ url('question') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group mb-2">
                <label for="questionText" class="sr-only">Question text</label>
                <input type="text" class="form-control" name="text" id="questionText" placeholder="Question text">
            </div>
            <select class="form-select" name="topic_id" id="topicId" aria-label="Default select example">
                <option selected>Open this select menu</option>
                @foreach ($topics as $topic)
                    <option value="{{$topic->id}}">{{$topic->name}}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mb-2 my-sm-3">Create question</button>
        </form>

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">
                    ID
                </th>
                <th scope="col">
                    Name
                </th>
                <th scope="col">
                    Topic
                </th>
                <th scope="col">
                    Delete
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($questions as $question)
                <tr>
                    <th scope="row">
                        <div>{{ $question->id }}</div>
                    </th>
                    <td>
                        <div>{{ $question->text }}</div>
                    </td>
                    <td>
                        <div>{{ $question->topic_id }}</div>
                    </td>
                    <td>
                        <form action="{{ url('questions/'.$question->id) }}" method="POST">
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
