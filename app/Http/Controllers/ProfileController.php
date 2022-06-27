<?php

namespace App\Http\Controllers;

use App\User;
use App\Survey;
use App\Profile;
use App\Questionnaire;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Questionnaire $questionnaire, Survey $survey)
    {
        if (Auth::user()->hasPermissionTo('profiles')) {
            $profiles = Profile::where('user_id', Auth::id())->get();
            $surveys = Survey::with('surveyresponses')->where('user_id', Auth::id())->get();
            return view('backend.profiles.index', compact(['profiles', 'surveys']));
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengakses profil!');

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
    public function show($id)
    {
        //
    }

    public function showSurveyResponseByProfile(User $user, Questionnaire $questionnaire, Survey $survey)
    {
        if (Auth::user()->hasPermissionTo('show surveyresponse by profile')) {
            $surveys = Survey::with('surveyresponses')->where([
                ['user_id', Auth::id()],
                ['questionnaire_id', $questionnaire->id],
            ])->get();

            foreach ($surveys as $key => $survey) {
                $questionnaire = $survey->questionnaire_id;
                $period = $survey->questionnaire->period;
            }
            return view('backend.profiles.show-surveyresponse-by-profile', compact(['surveys','period','questionnaire']));
        }
        return redirect('profiles')->with('toast_warning','Anda tidak diizinkan melihat hasil survei berdasarkan pengguna alumni!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Profile $profile)
    {
        if (Auth::user()->hasPermissionTo('edit profiles')) {
            $user = User::findOrfail(Auth::id());
            $roles = Role::whereNotin('name', ['super admin'])->get();
            $profiles = Profile::where('user_id',Auth::id())->get();
            return view('backend.profiles.edit', compact(['user','roles','profiles']));
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengubah data profil!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Profile $profile)
    {
        if (Auth::user()->hasPermissionTo('update profiles')) {
            $user = User::findOrfail(Auth::id());

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,'.Auth::id(),
                'password' => 'nullable|min:6',
                'phone' => 'required|string|max:15',
                'position' => 'required|string',
                'gender' => 'required|string|max:9',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif'
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }

            $password = !empty($request->password) ? bcrypt($request->password):$user->password;

            if ($request->hasFile('avatar'))
            {
                $oldfile = public_path().'/storage/users/'.Auth::user()->profile->avatar;
                if(!empty(Auth::user()->profile->avatar))
                {
                    unlink($oldfile);
                }
                $file = $request->file('avatar');
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $today = Auth::user()->name.'-'.md5(rand(0,9));
                $fileName = $today.Auth::user()->id.'.'.$extension;
                $path = "storage/users";
                $avatar = $file->move($path, $fileName);
                $user->profile->update([
                    'avatar' => $fileName
                ]);
            }

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $password
            ]);
            $user->profile->update([
                'phone' => $request->input('phone'),
                'position' => $request->input('position'),
                'gender' => $request->input('gender'),
            ]);

            return redirect('profiles')->with('toast_success', 'Data profil berhasil diperbaharui!');
        }
        return redirect()->back()->with('toast_warning', 'Anda tidak diizinkan mengubah data profil!');
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
