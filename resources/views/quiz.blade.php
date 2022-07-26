@extends('layouts.app')

@section('content')
    <div class="container">
       <ul class="list-group mb-2">
           @foreach ($quizzes as $key => $quiz)
           <li class="list-group-item">{{ $quiz->title }}
               <ul class="list-group mb-2">
                   @foreach( $quizzesQuestions[$key] as $quizzesQuestion)
                       <li class="list-group-item">
                           {{ $quizzesQuestion->text }}
                       </li>
                   @endforeach
               </ul>
           @endforeach
       </ul>

       <form class="" action="{{ url('quizzes') }}" method="POST">
           {{ csrf_field() }}
           <div class="form-group mb-2">
               <label for="topicText" class="sr-only">Quiz name</label>
               <input type="text" class="form-control" name="title" placeholder="Quiz name">
           </div>
           <button type="submit" class="btn btn-primary mb-2">Create quiz</button>
       </form>

        <form class="form-inline" action="{{url('quiz-add-question')}}" method="POST">
            {{ csrf_field() }}
            <select class="form-select mb-2" name="quiz_id">
                <option selected>Open this select menu</option>
                @foreach ($quizzes as $quiz)
                    <option value="{{$quiz->id}}">{{$quiz->title}}</option>
                @endforeach
            </select>
            <select class="form-select mb-2" name="question_id">
                <option selected>Open this select menu</option>
                @foreach ($questions as $question)
                    <option value="{{$question->id}}">{{$question->text}}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mb-2">Add question</button>
        </form>
    </div>
@endsection
