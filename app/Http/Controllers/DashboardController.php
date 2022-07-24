<?php

namespace App\Http\Controllers;

use App\User;
use App\Result;
use App\Variable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{

    public function index()
    {
        $roles = Role::get();
        $date = Carbon::now();
        $greetings = "";
        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            $greetings = "Selamat Pagi";
        } else
        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
        if ($time >= "12" && $time < "17") {
            $greetings = "Selamat Siang";
        } else
        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
        if ($time >= "17" && $time < "19") {
            $greetings = "Selamat Malam";
        } else
        /* Finally, show good night if the time is greater than or equal to 1900 hours */
        if ($time >= "19") {
            $greetings = "Selamat Malam";
        }

        $roleuser = 'user';
        $roleadmin = 'admin';
        $users = User::whereHas('roles', function (Builder $query) use ($roleuser) { $query->where('name', $roleuser); })->count();
        $admins = User::whereHas('roles', function (Builder $query) use ($roleadmin) { $query->where('name', $roleadmin); })->count();
        $total_alumni = DB::table('surveys')->sum('total_alumni');
        $questionnaires = DB::table('questionnaires')->count('id');
        $questions = DB::table('questions')->count('id');
        $criterias = DB::table('criterias')->count('id');
        $sets = DB::table('sets')->count('id');
        $rules = DB::table('rules')->count('id');
        $surveys = DB::table('surveys')->count('id');
        $variables = Variable::all();
        $results = Result::all();

        $categories = [];
        $softskill = [];
        $hardskill = [];
        $performance = [];

        foreach ($variables as $key => $variable) {
            $categories[] = $variable->questionnaire->period;
            $softskill[] = $variable->softskill;
            $hardskill[] = $variable->hardskill;
        }

        foreach ($results as $key => $result) {
            $performance[] = $result->performance;
        }

        $databars = Variable::all();

        $bar[] = ['Periode','Softskill','Hardskill'];
        foreach ($databars as $key => $value) {
            $bar[++$key] = [date($value->questionnaire->period), $value->softskill, $value->hardskill];
        }

        $dataresultbars = Result::all();

        $resultbar[] = ['Periode','Kinerja'];
        foreach ($dataresultbars as $key => $value) {
            $resultbar[++$key] = [date($value->variable->questionnaire->period), $value->performance];
        }

        return view('backend.dashboard.index', compact(['roles', 'greetings', 'date', 'admins', 'users', 'total_alumni', 'questionnaires', 'questions', 'criterias', 'sets', 'rules', 'surveys', 'performance', 'variables', 'results', 'categories', 'softskill', 'hardskill']))->with('databars',json_encode($bar))->with('dataresultbars',json_encode($resultbar));
    }

}
