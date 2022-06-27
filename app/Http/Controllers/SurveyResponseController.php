<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Survey;
use App\Question;
use App\Variable;
use App\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SurveyResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('surveyresponses')) {
            $questionnaires = Questionnaire::all();
            return view('backend.surveyresponses.index', compact('questionnaires'));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan mengelola hasil survei!');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire, $questionnaire_id, Survey $survey)
    {
        if (Auth::user()->hasPermissionTo('show surveyresponses')) {
            $surveys = Survey::where('questionnaire_id', $questionnaire_id)->get();
            if (empty(count($surveys))) {
                Alert::error('Maaf, pengguna alumni belum mengisi tanggapan untuk periode tersebut.');
                return redirect()->back();
            }

            foreach ($surveys as $key => $survey) {
                $questionnaire = $survey->questionnaire->id;
                $period = $survey->questionnaire->period;
            }

            $softskills = Question::with('answers')->where('questionnaire_id',$questionnaire_id)->where('criteria_id','=', '1')->get();
            $hardskills = Question::with('answers')->where('questionnaire_id',$questionnaire_id)->where('criteria_id','=', '2')->get();
            // dd($questions);
            $max_answer_value = Answer::select('value')->max('value');
            $count_question_softskill = Question::select('name')->where('criteria_id','=', '1')->count('name');
            $count_question_hardskill = Question::select('name')->where('criteria_id','=', '2')->count('name');

            return view('backend.surveyresponses.show', compact([
                'surveys', 'period', 'questionnaire', 'softskills', 'hardskills', 'max_answer_value', 'count_question_softskill', 'count_question_hardskill'
            ]));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan melihat hasil survei!');
    }

    public function showByUser(Questionnaire $questionnaire, Survey $survey, $user_id)
    {
        if (Auth::user()->hasPermissionTo('show by user surveyresponses')) {
            $surveys = Survey::with('surveyresponses')->where([
                ['user_id', $user_id],
                ['questionnaire_id', $questionnaire->id],
            ])->get();

            foreach ($surveys as $key => $survey) {
                $questionnaire = $survey->questionnaire_id;
                $period = $survey->questionnaire->period;
            }
            return view('backend.surveyresponses.show-by-user', compact(['surveys','period','questionnaire']));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan melihat hasil survei berdasarkan pengguna alumni!');
    }

    public function destroyByUser(Questionnaire $questionnaire, Survey $survey, $user_id)
    {
        if (Auth::user()->hasPermissionTo('show by user surveyresponses')) {
            if($questionnaire->user_id == Auth::id()){
                $surveys = Survey::with('surveyresponses')->where([
                    ['user_id', $user_id],
                    ['questionnaire_id', $questionnaire->id],
                ])->get();

                foreach ($surveys as $survey) {
                    $survey->surveyresponses()->delete();
                }

                $survey->delete();

                if ($questionnaire->variable()->count() != 0) {
                    if ($questionnaire->variable->result()->count() != 0) {
                        $questionnaire->variable->result()->delete();
                    }
                }

                if ($questionnaire->variable()->count() != 0) {
                    $questionnaire->variable()->delete();
                }

                return redirect('surveyresponses')->with('success', 'Data '.$questionnaire->title.' Berhasil dihapus!');
            }
            return redirect('surveyresponses')->with('error', 'Maaf, anda bukan admin. Data tidak dihapus!');
        }
        return redirect('surveyresponses')->with('toast_warning', 'Anda tidak diizinkan menghapus kuesioner!');
    }

    public function calculate(Questionnaire $questionnaire, Request $request, Variable $variable)
    {
        if (Auth::user()->hasPermissionTo('calculate surveyresponses')) {
            $softskills = Question::with('answers')->where('questionnaire_id',$questionnaire->id)->where('criteria_id','=', '1')->get();
            $hardskills = Question::with('answers')->where('questionnaire_id',$questionnaire->id)->where('criteria_id','=', '2')->get();
            foreach ($softskills as $key => $question) {
                $questionnaire_id = $question->questionnaire->id;
                $period = $question->questionnaire->period;
            }

            $max_answer_value = Answer::select('value')->max('value');
            $count_question_softskill = Question::select('name')->where('criteria_id','=', '1')->where('questionnaire_id',$questionnaire->id)->count('name');
            $count_question_hardskill = Question::select('name')->where('criteria_id','=', '2')->where('questionnaire_id',$questionnaire->id)->count('name');

            $sum_index_softskill = 0;
            foreach ($softskills as $key=> $question){
                foreach ($question->answers as $answer){
                }
                foreach ($question->answers as $answer){
                    $answer->surveyresponses->count();
                }
                $sum_skor = 0;
                foreach ($question->answers as $answer){
                    $answer->surveyresponses->count()*$answer->value;
                    $sum_skor += $answer->surveyresponses->count()*$answer->value;
                }
                $sum_skor;
                $softskill_index = ($sum_skor/($max_answer_value*$question->questionnaire->surveys->count()))*100;
                $sum_index_softskill += $softskill_index;
            }
            $softskill = number_format($sum_index_softskill/$count_question_softskill, 2, '.', '');

            //Perhitungan Kuesioner Hardskill
            $sum_index_hardskill = 0;
            foreach ($hardskills as $key=> $question){
                foreach ($question->answers as $answer){
                }
                foreach ($question->answers as $answer){
                $answer->surveyresponses->count();
                }
                $sum_skor = 0;
                foreach ($question->answers as $answer){
                    $answer->surveyresponses->count()*$answer->value;
                    $sum_skor += $answer->surveyresponses->count()*$answer->value;
                }
                $sum_skor;
                $hardskill_index = ($sum_skor/($max_answer_value*$question->questionnaire->surveys->count()))*100;
                $sum_index_hardskill += $hardskill_index;
            }
            $hardskill = number_format($sum_index_hardskill/$count_question_hardskill, 2, '.', '');

            $variable = Variable::where('questionnaire_id', $questionnaire->id)->get();

            if (empty(count($variable))) {

                $questionnaire->variable()->create([
                    'softskill' => $softskill,
                    'hardskill' => $hardskill,
                ]);
            }

            $questionnaire->variable()->update([
                'softskill' => $softskill,
                'hardskill' => $hardskill,
            ]);

            Alert::toast('Perhitungan Kuesioner Periode '.$period.' Berhasil', 'success');
            return view('backend.surveyresponses.calculate', compact([
                'softskills', 'hardskills', 'max_answer_value', 'questionnaire_id', 'period', 'count_question_softskill', 'count_question_hardskill', 'variable'
            ]));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan menghitung hasil survei!');
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
