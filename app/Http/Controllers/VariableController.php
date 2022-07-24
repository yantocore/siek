<?php

namespace App\Http\Controllers;

use App\Set;
use App\Rule;
use App\Answer;
use App\Result;
use App\Criteria;
use App\Question;
use App\Variable;
use App\Questionnaire;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class VariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Questionnaire $questionnaire)
    {
        if (Auth::user()->hasPermissionTo('variables')) {
            $questionnaires = Questionnaire::all();
            $variables = Variable::all();
            return view('backend.variables.index', compact(['variables', 'questionnaires']));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan mengelola variabel!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($questionnaire)
    {

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
    public function show(Variable $variable, Questionnaire $questionnaire)
    {
        if (Auth::user()->hasPermissionTo('show variables')) {
            $softskills = Question::with('answers')->where('questionnaire_id',$variable->questionnaire_id)->where('criteria_id','=', '1')->get();
            $hardskills = Question::with('answers')->where('questionnaire_id',$variable->questionnaire_id)->where('criteria_id','=', '2')->get();
            $period = $variable->questionnaire->period;

            $max_answer_value = Answer::select('value')->max('value');
            $count_question_softskill = Question::select('name')->where('criteria_id','=', '1')->where('questionnaire_id',$variable->questionnaire_id)->count('name');
            $count_question_hardskill = Question::select('name')->where('criteria_id','=', '2')->where('questionnaire_id',$variable->questionnaire_id)->count('name');

            $datavariables = Variable::where('id', $variable->id)->get();

            $gauge[] = ['Softskill', 'Hardskill'];
            foreach ($datavariables as $key => $value) {
                $gauge[++$key] = [$value->softskill, $value->hardskill];
            }

            return view('backend.variables.show', compact([
                'questionnaire', 'softskills', 'hardskills', 'max_answer_value', 'period', 'count_question_softskill', 'count_question_hardskill', 'variable'
            ]))->with('datavariables',json_encode($gauge));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan melihat variabel!');
    }

    public function evaluate(Request $request,  Variable $variable, Questionnaire $questionnaire)
    {
        if (Auth::user()->hasPermissionTo('evaluate variables')) {
            $variables = Variable::where('questionnaire_id', $questionnaire->id)->get();
            $softskill = Variable::select('softskill')->where('questionnaire_id', $questionnaire)->get();
            $hardskill = Variable::select('hardskill')->where('questionnaire_id', $questionnaire)->get();
            $criterias = Criteria::all();
            $sets_kurang = Set::where('name','kurang')->get();
            foreach ($sets_kurang as $key => $set_kurang) {
                $set_kurang->left_down;
                $set_kurang->left_up;
                $set_kurang->right_up;
                $set_kurang->right_down;
            }
            $sets_cukup = Set::where('name','cukup')->get();
            foreach ($sets_cukup as $key => $set_cukup) {
                $set_cukup->left_down;
                $set_cukup->left_up;
                $set_cukup->right_up;
                $set_cukup->right_down;
            }
            $sets_baik = Set::where('name','baik')->get();
            foreach ($sets_baik as $key => $set_baik) {
                $set_baik->left_down;
                $set_baik->left_up;
                $set_baik->right_up;
                $set_baik->right_down;
            }

            $rules = Rule::select('rules.*', 'setsone.name as first_set', 'setstwo.name as second_set')
                        ->leftjoin('sets as setsone', 'setsone.id', '=', 'rules.first_set_id')
                        ->leftjoin('sets as setstwo', 'setstwo.id', '=', 'rules.second_set_id')
                        ->get();

            $z_satu = Rule::select('performance')->where('name', '=', 'R1')->first();
            $z_dua = Rule::select('performance')->where('name', '=', 'R2')->first();
            $z_tiga = Rule::select('performance')->where('name', '=', 'R3')->first();
            $z_empat = Rule::select('performance')->where('name', '=', 'R4')->first();
            $z_lima = Rule::select('performance')->where('name', '=', 'R5')->first();
            $z_enam = Rule::select('performance')->where('name', '=', 'R6')->first();
            $z_tujuh = Rule::select('performance')->where('name', '=', 'R7')->first();
            $z_delapan = Rule::select('performance')->where('name', '=', 'R8')->first();
            $z_sembilan = Rule::select('performance')->where('name', '=', 'R9')->first();

            //Data Variabel
            foreach ($variables as $key=> $variable){
                $variable->softskill;
                $variable->hardskill;
            }
            //Fuzzifikasi
            foreach ($variables as $key=> $variable){
                //softskill_kurang
                    if ($variable->softskill <= $set_kurang->right_up){
                        $softskill_kurang = number_format(1, 2, '.', '');
                    }elseif($set_kurang->right_up < $variable->softskill && $variable->softskill < $set_kurang->right_down){
                        $softskill_kurang = number_format(($set_kurang->right_down - $variable->softskill)/($set_kurang->right_down - $set_kurang->right_up), 2, '.', '');
                    }elseif($variable->softskill >= $set_kurang->right_down){
                        $softskill_kurang = number_format(0, 2, '.', '');
                    }
                //softskill_cukup
                    if ($variable->softskill <= $set_cukup->left_down){
                        $softskill_cukup = number_format(0, 2, '.', '');
                    }elseif($set_cukup->left_down < $variable->softskill && $variable->softskill <= $set_cukup->left_up){
                        $softskill_cukup = number_format(($variable->softskill - $set_cukup->left_down)/($set_cukup->left_up - $set_cukup->left_down), 2, '.', '');
                    }elseif($set_cukup->left_up < $variable->softskill && $variable->softskill <= $set_cukup->right_up){
                        $softskill_cukup = number_format(1, 2, '.', '');
                    }elseif($set_cukup->right_up < $variable->softskill && $variable->softskill < $set_cukup->right_down){
                        $softskill_cukup = number_format(($set_cukup->right_down - $variable->softskill)/($set_cukup->right_down - $set_cukup->right_up), 2, '.', '');
                    }elseif($variable->softskill >= $set_cukup->right_down){
                        $softskill_cukup = number_format(0, 2, '.', '');
                    }
                //softskill_baik
                    if ($variable->softskill <= $set_baik->left_down){
                        $softskill_baik = number_format(0, 2, '.', '');
                    }elseif($set_baik->left_down < $variable->softskill && $variable->softskill <= $set_baik->left_up){
                        $softskill_baik = number_format(($variable->softskill - $set_baik->left_down)/($set_baik->left_up - $set_baik->left_down), 2, '.', '');
                    }elseif($variable->softskill >= $set_baik->left_up){
                        $softskill_baik = number_format(1, 2, '.', '');
                    }

                //hardskill_kurang
                    if ($variable->hardskill <= $set_kurang->right_up){
                        $hardskill_kurang = number_format(1, 2, '.', '');
                    }elseif($set_kurang->right_up < $variable->hardskill && $variable->hardskill < $set_kurang->right_down){
                        $hardskill_kurang = number_format(($set_kurang->right_down - $variable->hardskill)/($set_kurang->right_down - $set_kurang->right_up), 2, '.', '');
                    }elseif($variable->hardskill >= $set_kurang->right_down){
                        $hardskill_kurang = number_format(0, 2, '.', '');
                    }
                //hardskill_cukup
                    if ($variable->hardskill <= $set_cukup->left_down){
                        $hardskill_cukup = number_format(0, 2, '.', '');
                    }elseif($set_cukup->left_down < $variable->hardskill && $variable->hardskill <= $set_cukup->left_up){
                        $hardskill_cukup = number_format(($variable->hardskill - $set_cukup->left_down)/($set_cukup->left_up - $set_cukup->left_down), 2, '.', '');
                    }elseif($set_cukup->left_up < $variable->hardskill && $variable->hardskill <= $set_cukup->right_up){
                        $hardskill_cukup = number_format(1, 2, '.', '');
                    }elseif($set_cukup->right_up < $variable->hardskill && $variable->hardskill < $set_cukup->right_down){
                        $hardskill_cukup = number_format(($set_cukup->right_down - $variable->hardskill)/($set_cukup->right_down - $set_cukup->right_up), 2, '.', '');
                    }elseif($variable->hardskill >= $set_cukup->right_down){
                        $hardskill_cukup = number_format(0, 2, '.', '');
                    }
                //hardskill_baik
                    if ($variable->hardskill <= $set_baik->left_down){
                        $hardskill_baik = number_format(0, 2, '.', '');
                    }elseif($set_baik->left_down < $variable->hardskill && $variable->hardskill <= $set_baik->left_up){
                        $hardskill_baik = number_format(($variable->hardskill - $set_baik->left_down)/($set_baik->left_up - $set_baik->left_down), 2, '.', '');
                    }elseif($variable->hardskill >= $set_baik->left_up){
                        $hardskill_baik = number_format(1, 2, '.', '');
                    }
            }

            //Alpha Predikat
            foreach ($variables as $key=> $variable){
                $alpha_satu = min($softskill_kurang,$hardskill_kurang);
                $alpha_dua = min($softskill_kurang,$hardskill_cukup);
                $alpha_tiga = min($softskill_kurang,$hardskill_baik);
                $alpha_empat = min($softskill_cukup,$hardskill_kurang);
                $alpha_lima = min($softskill_cukup,$hardskill_cukup);
                $alpha_enam = min($softskill_cukup,$hardskill_baik);
                $alpha_tujuh = min($softskill_baik,$hardskill_kurang);
                $alpha_delapan = min($softskill_baik,$hardskill_cukup);
                $alpha_sembilan = min($softskill_baik,$hardskill_baik);
            }

            $sum_alpha_z = ($alpha_satu*$z_satu['performance']+$alpha_dua*$z_dua['performance']+$alpha_tiga*$z_tiga['performance']+$alpha_empat*$z_empat['performance']+$alpha_lima*$z_lima['performance']+$alpha_enam*$z_enam['performance']+$alpha_tujuh*$z_tujuh['performance']+$alpha_delapan*$z_delapan['performance']+$alpha_sembilan*$z_sembilan['performance']);

            $sum_alpha = ($alpha_satu+$alpha_dua+$alpha_tiga+$alpha_empat+$alpha_lima+$alpha_enam+$alpha_tujuh+$alpha_delapan+$alpha_sembilan);

            //Defuzzifikasi
            if($sum_alpha>0 && $sum_alpha_z>0){
                $nilai_z = round($sum_alpha_z/$sum_alpha,2);
            }else {
                $nilai_z = 0;
            }

            $result = Result::where('variable_id', $variable->id)->get();

            if (empty(count($result))) {

                $variable->result()->create([
                    'sum_alpha' => $sum_alpha,
                    'sum_alpha_z' => $sum_alpha_z,
                    'performance' => $nilai_z
                ]);
            }

            $variable->result()->update([
                'sum_alpha' => $sum_alpha,
                'sum_alpha_z' => $sum_alpha_z,
                'performance' => $nilai_z
            ]);

            Alert::toast('Evaluasi Kinerja Pengguna Alumni Pada Kuesioner Periode '.$questionnaire->period.' Berhasil', 'success');

            return view('backend.variables.evaluate', compact([
                'variables','softskill', 'hardskill', 'questionnaire', 'criterias', 'set_kurang', 'set_cukup', 'set_baik', 'rules', 'z_satu', 'z_dua', 'z_tiga', 'z_empat', 'z_lima', 'z_enam', 'z_tujuh', 'z_delapan', 'z_sembilan', 'nilai_z', 'variable'
            ]));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan mengevaluasi variabel!');
    }

    public function exportPDF(Request $request, Variable $variable, Questionnaire $questionnaire)
    {
        $softskills = Question::with('answers')->where('questionnaire_id',$questionnaire->id)->where('criteria_id','=', '1')->get();
        $hardskills = Question::with('answers')->where('questionnaire_id',$questionnaire->id)->where('criteria_id','=', '2')->get();
        $period = $questionnaire->period;

        $max_answer_value = Answer::select('value')->max('value');
        $count_question_softskill = Question::select('name')->where('criteria_id','=', '1')->where('questionnaire_id',$questionnaire->id)->count('name');
        $count_question_hardskill = Question::select('name')->where('criteria_id','=', '2')->where('questionnaire_id',$questionnaire->id)->count('name');

        $datavariables = Variable::where('id', $questionnaire->variable->id)->get();
        // dd($questionnaire->variable->id);

        $gauge[] = ['Softskill', 'Hardskill'];
        foreach ($datavariables as $key => $value) {
            $gauge[++$key] = [$value->softskill, $value->hardskill];
        }

        // $view = view('backend.variables.export-pdf', compact(['variables','softskill', 'hardskill', 'questionnaire', 'criterias', 'set_kurang', 'set_cukup', 'set_baik', 'rules', 'z_satu', 'z_dua', 'z_tiga', 'z_empat', 'z_lima', 'z_enam', 'z_tujuh', 'z_delapan', 'z_sembilan'
        // ]))->with('dataresults',json_encode($resultgauge))->render();
        $pdf = PDF::loadview('backend.variables.export-pdf', compact([
            'questionnaire', 'softskills', 'hardskills', 'max_answer_value', 'period', 'count_question_softskill', 'count_question_hardskill', 'variable'
        ]))->setPaper('A4', 'potrait');
        return $pdf->stream('laporan_hasil_kuesioner_'.$questionnaire->period.'_'.date('Y-m-d').'.pdf');
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
