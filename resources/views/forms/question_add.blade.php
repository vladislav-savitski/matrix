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
