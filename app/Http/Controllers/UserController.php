<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        if (Auth::user()->hasPermissionTo('users')) {
            $admins = User::role(['director', 'admin'])->get();
            $users = User::role('user')->get();
            return view('backend.users.index', compact(['admins','users']));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan mengelola users!');

    }

    public function create()
    {
        if (Auth::user()->hasPermissionTo('create users')) {
            $roles = Role::whereNotin('name', ['super admin'])->get();
            return view('backend.users.create', compact('roles'));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan membuat users!');
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasPermissionTo('store users')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required|string|exists:roles,name',
                'position' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ]);
            $user->profile()->create([
                'position' => $request->input('position')
            ]);
            $user->save();
            $user->assignRole($request->role);
            return redirect('users')->with('toast_success', 'Data '.$user->name.' berhasil ditambahkan!');
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan membuat users!');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        if (Auth::user()->hasPermissionTo('edit users')) {
            $user = User::findOrfail($user->id);
            $roles = Role::whereNotin('name', ['super admin'])->get();
            return view('backend.users.edit', compact(['user','roles']));
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan mengubah users!');
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->hasPermissionTo('update users')) {
            $user = User::findOrfail($user->id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'password' => 'nullable|min:6',
                'role' => 'required|string|exists:roles,name',
                'position' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }

            $password = !empty($request->password) ? bcrypt($request->password):$user->password;
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $password
            ]);
            $user->profile()->update([
                'position' => $request->input('position')
            ]);
            $user->syncRoles($request->role);

            return redirect('users')->with('toast_success', 'Data '.$user->name.' berhasil diperbaharui!');
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan mengubah users!');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->hasPermissionTo('destroy users')) {
            if($user->id == Auth::id() && Auth::user()->hasRole('admin')){
                Alert::error('Perhatian!', 'Maaf, anda tidak diizinkan untuk menghapus akun anda sendiri!');
                return redirect()->back();
            }else if($user->id == $user->hasRole('super admin') && Auth::user()->hasRole('admin')){
                Alert::error('Perhatian!', 'Maaf, anda tidak diiinkan untuk menghapus akun tersebut!');
                return redirect()->back();
            }
            $oldfile = public_path().'/storage/users/'.$user->profile->avatar;
            if(!empty($user->profile->avatar))
            {
                unlink($oldfile);
            }
            if ($user->surveys->count() != 0) {
                foreach ($user->surveys as $survey) {
                    $survey->surveyresponses()->delete();
                }
                $user->surveys()->delete();
            }
            if ($user->profile()->count() != 0) {
                $user->profile()->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'Data '.$user->name.' Berhasil dihapus!');
        }
        return redirect()->back()->with('toast_warning','Anda tidak diizinkan menghapus users!');
    }
}
