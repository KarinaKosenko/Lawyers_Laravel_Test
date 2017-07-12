<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function index()
    {
        if (!Auth::check()){
            return view('layouts.single', [
                'page' => 'pages.indexGuestPage',
            ]);
        }
        else {
            return view('layouts.single', [
                'page' => 'pages.indexLawyerPage',
                'user' => Auth::user(),
            ]);
        }
    }


    public function edit($id_user)
    {
        $user = User::findOrFail($id_user);

        return view('layouts.single', [
            'page' => 'pages.editProfilePage',
            'user' => $user,
        ]);
    }


    public function editPost($id_user, Request $request)
    {
        $user = User::findOrFail($id_user);

        $this->validate($request, [
                'name' => 'required|max:200|min:2',
                'address' => 'required|min:10',
                'email' => [
                        'required',
                        'email',
                         Rule::unique('users')->ignore($user->id),
                        'max:200',
                    ],
                'phone' => 'required|numeric',
                'birthday' => 'required',
                'date' => 'required',
                'password' => 'required|max:200|min:6',
                'password2' => 'required|same:password',
        ]);

        $user->update($request->except('password2'));

        return redirect()
            ->route('public.profiles.index');
    }
}
