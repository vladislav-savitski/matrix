@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-inline" action="{{ url('topic') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group mb-2">
                <label for="topicText" class="sr-only">Topic text</label>
                <input type="text" class="form-control" name="name" id="topicText" placeholder="Topic text">
            </div>

            <button type="submit" class="btn btn-primary mb-2">Create topic</button>
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
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($topics as $topic)
                <tr>
                    <th scope="row">
                        <div>{{ $topic->id }}</div>
                    </th>
                    <td>
                        <div>{{ $topic->name }}</div>
                    </td>
                    <td>
                        <form action="{{ url('topics/'.$topic->id) }}" method="POST">
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
