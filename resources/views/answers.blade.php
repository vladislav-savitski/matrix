@extends('layouts.app')

@section('content')
    <div class="container">
        @include('forms.question_add')

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
                        Topic
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
                        <div>{{ $answer->correct === 1 ? 'Yes' : 'No'}}</div>
                    </td>
                    <td>
                        <form action="{{ url('answer/'.$answer->id) }}" method="POST">
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
