<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Survey;
use App\Question;
use Carbon\Carbon;
use App\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('surveys')) {
            $date_now = Carbon::now()->format('Y-m-d');
            $questionnaires = Questionnaire::where('status','buka')->where('due_date', '>=',$date_now)->get();
            return view('backend.surveys.index', compact('questionnaires'));
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengelola survei!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Questionnaire $questionnaire)
    {
        if (Auth::user()->hasPermissionTo('store surveys')) {
            $surveys = Survey::where('user_id', Auth::id())->where('questionnaire_id',$questionnaire->id)->first();
            $data = request()->validate([
                'survey_responses.*.answer_id' => 'required',
                'survey_responses.*.question_id' => 'required',
                'surveys.agency' => 'required',
                'surveys.agency_field' => 'required',
                'surveys.address' => 'required',
                'surveys.total_alumni' => 'required',
                'surveys.minimum_gpa' => 'required',
                'surveys.feedback' => 'required',
            ]);

            $data['surveys']['user_id'] = Auth::id();

            if (is_null($surveys)) {
                $survey = $questionnaire->surveys()->create($data['surveys']);
                $survey->surveyresponses()->createMany($data['survey_responses']);

                return redirect('surveys')->with('success', 'Terima kasih atas partisipasi Bapak/Ibu.');
            }
            Alert::error('Maaf, sepertinya Bapak/Ibu telah melakukan pengisian kuesioner.');
            return redirect('surveys');
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan menyimpan survei!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire, Question $question, Answer $answer, $slug)
    {
        if (Auth::user()->hasPermissionTo('show surveys')) {
            $surveys = Survey::where('user_id', Auth::id())->where('questionnaire_id',$questionnaire->id)->first();
            $questions = Question::where('questionnaire_id',$questionnaire->id)->get();
            foreach ($questions as $key => $question) {
                $question_id = $question->id;
            }
            $answers = Answer::where('question_id',$question->id)->get();
            $total_questions = count($questionnaire->questions);
            $total_answers = count($question->answers);

            if ($questionnaire->status == 'tutup') {
                Alert::error('Mohon maaf, pengisian kuesioner ini belum dibuka.');
                return redirect()->back();
            }

            if (is_null($surveys)) {
                if($total_questions != 7){
                    Alert::error('Mohon maaf, kuesioner ini belum bisa diisi.');
                    return redirect()->back();
                }elseif($total_answers != 4){
                    Alert::error('Mohon maaf, kuesioner ini belum bisa diisi.');
                    return redirect()->back();
                }
                return view('backend.surveys.show', compact('questionnaire'));
            }
            Alert::error('Mohon maaf, sepertinya Bapak/Ibu telah melakukan pengisian kuesioner.');
            return redirect('surveys');

        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengisi survei!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
