<?php

namespace App\Http\Controllers;

use App\Set;
use App\Rule;
use App\Result;
use App\Criteria;
use App\Variable;
use App\Questionnaire;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Variable $variable)
    {
        if (Auth::user()->hasPermissionTo('results')) {
            $variables = Variable::all();
            $results = Result::all();
            return view('backend.results.index', compact(['results', 'variables']));
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengelola perhitungan!');
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
    public function show(Request $request, Questionnaire $questionnaire, Result $result)
    {
        if (Auth::user()->hasPermissionTo('show results')) {
            $variables = Variable::where('questionnaire_id', $result->variable->questionnaire_id)->get();
            $softskill = Variable::select('softskill')->where('questionnaire_id',$questionnaire)->get();
            $hardskill = Variable::select('hardskill')->where('questionnaire_id',$questionnaire)->get();
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
            $rules = Rule::select('rules.*','setsone.name as first_set','setstwo.name as second_set')
                        ->join('sets as setsone', 'setsone.id', '=', 'rules.first_set_id')
                        ->join('sets as setstwo', 'setstwo.id', '=', 'rules.second_set_id')
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

            $dataresults = Result::where('id',$result->id)->get();

            $resultgauge[] = ['Kinerja'];
            foreach ($dataresults as $key => $value) {
                $resultgauge[++$key] = [$value->performance];
            }

            return view('backend.results.show', compact([
                'result','variables','softskill', 'hardskill', 'questionnaire', 'criterias', 'set_kurang', 'set_cukup', 'set_baik', 'rules', 'z_satu', 'z_dua', 'z_tiga', 'z_empat', 'z_lima', 'z_enam', 'z_tujuh', 'z_delapan', 'z_sembilan'
            ]))->with('dataresults',json_encode($resultgauge));
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan melihat perhitungan!');
    }

    public function exportPDF(Request $request, Questionnaire $questionnaire, Result $result)
    {
        $variables = Variable::where('questionnaire_id', $result->variable->questionnaire_id)->get();
        $softskill = Variable::select('softskill')->where('questionnaire_id',$questionnaire)->get();
        $hardskill = Variable::select('hardskill')->where('questionnaire_id',$questionnaire)->get();
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
        $rules = Rule::select('rules.*','setsone.name as first_set','setstwo.name as second_set')
                    ->join('sets as setsone', 'setsone.id', '=', 'rules.first_set_id')
                    ->join('sets as setstwo', 'setstwo.id', '=', 'rules.second_set_id')
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

        $dataresults = Result::where('id',$result->id)->get();

        $resultgauge[] = ['Kinerja'];
        foreach ($dataresults as $key => $value) {
            $resultgauge[++$key] = [$value->performance];
        }

        // $view = view('backend.results.export-pdf', compact(['variables','softskill', 'hardskill', 'questionnaire', 'criterias', 'set_kurang', 'set_cukup', 'set_baik', 'rules', 'z_satu', 'z_dua', 'z_tiga', 'z_empat', 'z_lima', 'z_enam', 'z_tujuh', 'z_delapan', 'z_sembilan'
        // ]))->with('dataresults',json_encode($resultgauge))->render();
        $pdf = PDF::loadview('backend.results.export-pdf', compact(['variables','softskill', 'hardskill', 'questionnaire', 'criterias', 'set_kurang', 'set_cukup', 'set_baik', 'rules', 'z_satu', 'z_dua', 'z_tiga', 'z_empat', 'z_lima', 'z_enam', 'z_tujuh', 'z_delapan', 'z_sembilan'
        ]))->setPaper('A4', 'potrait');
        return $pdf->stream('laporan_kinerja_alumni_'.$questionnaire->period.'_'.date('Y-m-d').'.pdf');
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
