<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Result;
use App\Survey;
use App\Question;
use App\Variable;
use Carbon\Carbon;
use App\Questionnaire;
use App\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\QuestionnaireRequest;

class QuestionnaireController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasPermissionTo('questionnaires')) {
            $questionnaires = Questionnaire::all();
            $date_now = Carbon::now()->format('Y-m-d');
            $due = Questionnaire::where('due_date','<',$date_now)->where('status','buka')->get();
            $status = Questionnaire::where('status','buka')->get();
            $total_due = count($due);
            $total_status = count($status);

            if ($total_due >= 1) {
                DB::table('questionnaires')->update([
                    'status' => 'tutup',
                    'start_date' => NULL
                ]);
            }

            if($total_status >= 2){
                DB::table('questionnaires')->update([
                    'status' => 'tutup',
                    'start_date' => NULL
                ]);
                return redirect('questionnaires')->with('toast_warning', 'Maaf, ada dua status kuesioner yang terbuka secara bersamaan!');
            }
            return view('backend.questionnaires.index', compact('questionnaires'));

        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengelola kuesioner!');

    }

    public function create()
    {
        if (Auth::user()->hasPermissionTo('create questionnaires')) {
            return view('backend.questionnaires.create');
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan membuat kuesioner!');
    }

    public function store(QuestionnaireRequest $request)
    {
        if (Auth::user()->hasPermissionTo('store questionnaires')) {
            $questionnaire = auth()->user()->questionnaires()->create($request->validated());
            $questionnaire->update([
                'status' => 'tutup'
            ]);
            return redirect('questionnaires')->with('toast_success', 'Data '.$questionnaire->title.' berhasil ditambahkan!');
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan membuat kuesioner!');
    }

    public function show(Questionnaire $questionnaire, Question $question, Answer $answer)
    {
        if (Auth::user()->hasPermissionTo('show questionnaires')) {
            $questions = Question::where('questionnaire_id',$questionnaire->id)->get();
            foreach ($questions as $key => $question) {
                $question_id = $question->id;
            }
            $answers = Answer::where('question_id',$question->id)->get();
            $total_questions = count($questionnaire->questions);
            $total_answers = count($question->answers);

            if ($total_questions != 7) {

                Alert::error('Tambahkan pertanyaan terlebih dahulu!');
                return view('backend.questionnaires.show', compact('questionnaire', 'questions', 'answers', 'total_questions', 'total_answers'));
            }elseif ($total_answers != 4) {

                Alert::error('Tambahkan pilihan jawaban terlebih dahulu!');
                return view('backend.questionnaires.show', compact('questionnaire', 'questions', 'answers', 'total_questions', 'total_answers'));
            }

            $questionnaire->load('questions.answers.surveyresponses');

            return view('backend.questionnaires.show', compact('questionnaire', 'questions', 'answers', 'total_questions', 'total_answers'));
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan melihat kuesioner!');
    }

    public function assignQuestions(Questionnaire $questionnaire, Question $question)
    {
        if (Auth::user()->hasPermissionTo('assign questions')) {
            $questions = Question::where('questionnaire_id',$questionnaire->id)->get();
            if (count($questions) != 7) {
                $questions = [
                    ['questionnaire_id' => $questionnaire->id, 'criteria_id' => '1', 'name' => 'Etika'],
                    ['questionnaire_id' => $questionnaire->id, 'criteria_id' => '2', 'name' => 'Keahlian pada bidang ilmu (kompetensi utama)'],
                    ['questionnaire_id' => $questionnaire->id, 'criteria_id' => '2', 'name' => 'Kemampuan berbahasa asing'],
                    ['questionnaire_id' => $questionnaire->id, 'criteria_id' => '2', 'name' => 'Penggunaan teknologi informasi'],
                    ['questionnaire_id' => $questionnaire->id, 'criteria_id' => '1', 'name' => 'Kemampuan berkomunikasi'],
                    ['questionnaire_id' => $questionnaire->id, 'criteria_id' => '1', 'name' => 'Kerjasama tim'],
                    ['questionnaire_id' => $questionnaire->id, 'criteria_id' => '1', 'name' => 'Pengembangan diri'],
                ];
                DB::table('questions')->insert($questions);
                return redirect()->back();
            }
            return redirect()->back();
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan menambahkan pertanyaan!');
    }

    public function assignAnswers(Questionnaire $questionnaire, Question $question)
    {
        if (Auth::user()->hasPermissionTo('assign answers')) {
            $answers = Answer::where('question_id',$question->id)->get();
            if (count($answers) != 4) {
                $answers = [
                    ['question_id' => $question->id, 'name' => 'Sangat Baik', 'value' => '4'],
                    ['question_id' => $question->id, 'name' => 'Baik', 'value' => '3'],
                    ['question_id' => $question->id, 'name' => 'Cukup', 'value' => '2'],
                    ['question_id' => $question->id, 'name' => 'Kurang', 'value' => '1'],
                ];
                DB::table('answers')->insert($answers);
                return redirect()->back();
            }
            return redirect()->back();
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan menambahkan pilihan jawaban!');
    }

    public function changeStatus(Request $request)
    {
        if (Auth::user()->hasPermissionTo('questionnaires')) {
            $questionnaire = Questionnaire::findOrfail($request->questionnaire_id);
            $date_now = Carbon::now()->format('Y-m-d');
            $questionnaire->status = $request->status;
            if ($questionnaire->status == 'buka') {
                if ($questionnaire->due_date >= $date_now) {
                    $questionnaire->start_date = Carbon::now()->format('Y-m-d');
                    $questionnaire->save();

                    return response()->json(['message' => 'Questionnaire status updated successfully.']);
                }
                $questionnaire->status = 'tutup';
                $questionnaire->start_date = NULL;
                $questionnaire->save();

                Alert::error('Maaf, Periksa kembali tanggal tutup kuesioner!');

            }
            $questionnaire->status = 'tutup';
            $questionnaire->start_date = NULL;
            $questionnaire->save();

            return response()->json(['message' => 'Questionnaire status updated successfully.']);

        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengelola kuesioner!');
    }

    public function edit(Questionnaire $questionnaire)
    {
        if (Auth::user()->hasPermissionTo('edit questionnaires')) {
            return view('backend.questionnaires.edit', compact('questionnaire'));
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengubah kuesioner!');
    }

    public function update(QuestionnaireRequest $request, Questionnaire $questionnaire)
    {
        if (Auth::user()->hasPermissionTo('update questionnaires')) {
            $questionnaire->update($request->validated());
            return redirect('questionnaires')->with('toast_success', 'Kuesioner '.$questionnaire->title.' berhasil diperbaharui!');
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengubah kuesioner!');
    }

    public function destroy(Questionnaire $questionnaire, Question $question, Answer $answer, Survey $survey, SurveyResponse $surveyresponses, Result $result, Variable $variable)
    {
        if (Auth::user()->hasPermissionTo('destroy questionnaires')) {
            if($questionnaire->user_id == Auth::id()){
                if ($questionnaire->variable()->count() != 0) {
                    if ($questionnaire->variable->result()->count() != 0) {
                        $questionnaire->variable->result()->delete();
                    }
                }
                if ($questionnaire->variable()->count() != 0) {
                    $questionnaire->variable()->delete();
                }
                if ($questionnaire->surveys->count() != 0) {
                    foreach ($questionnaire->surveys as $survey) {
                        $survey->surveyresponses()->delete();
                    }
                    $questionnaire->surveys()->delete();
                }
                foreach ($questionnaire->questions as $question) {
                    if ($question->answers->count() != 0) {
                        $question->answers()->delete();
                    }
                }
                if ($questionnaire->questions->count() != 0) {
                    $questionnaire->questions()->delete();
                }
                $questionnaire->delete();
                return redirect()->back()->with('success', 'Data '.$questionnaire->title.' Berhasil dihapus!');
            }
            return redirect()->back()->with('error', 'Maaf, anda bukan admin. Data tidak dihapus!');
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan menghapus kuesioner!');
    }
}
