@php
$sum_index_hardskill = 0
@endphp
@foreach ($hardskills as $key=> $question)
    @foreach ($question->answers as $answer)
    @endforeach
    @foreach ($question->answers as $answer)
    @php
        $answer->surveyresponses->count()
    @endphp
    @endforeach
    @php
        $sum_skor = 0
    @endphp
    @foreach ($question->answers as $answer)
    @php
        $answer->surveyresponses->count()*$answer->value
    @endphp
    @php
        $sum_skor += $answer->surveyresponses->count()*$answer->value
    @endphp
    @endforeach
    @php
        $sum_skor
    @endphp
    @php
        $hardskill_index = ($sum_skor/($max_answer_value*$question->questionnaire->surveys->count()))*100
    @endphp
    @php
        $sum_index_hardskill += $hardskill_index
    @endphp
@endforeach
@php
    $hardskill = $sum_index_hardskill/$count_question_hardskill
@endphp
