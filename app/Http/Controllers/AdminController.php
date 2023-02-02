<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Only for Admins
        if (\Auth::user()->role_id < 3) {
            $courses = UserCourse::whereHas('user', function ($q) {
                $q->where('user_id', '=', \Auth::user()->id);
            })->get();
            return redirect()->route('home', ['courses' => $courses]);
        }
        $users = User::orderBy('id', 'asc')->get();
        $courses = Course::orderBy('id', 'asc')->get();
        $enrolls = UserCourse::orderBy('id', 'asc')->get();
        return view('admin', ['users' => $users, 'courses' => $courses, 'enrolls' => $enrolls]);
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

    public function edituser ($id) {
        // Only for Admins
        if (\Auth::user()->role_id < 3) {
            $courses = UserCourse::whereHas('user', function ($q) {
                $q->where('user_id', '=', \Auth::user()->id);
            })->get();
            return redirect()->route('home', ['courses' => $courses]);
        }
        $user = User::find($id);
        return view('adminEditUser', ['user' => $user]);
    }

    public function updateuser (Request $request, $id) {
        // Only for Admins
        if (\Auth::user()->role_id < 3) {
            $courses = UserCourse::whereHas('user', function ($q) {
                $q->where('user_id', '=', \Auth::user()->id);
            })->get();
            return redirect()->route('home', ['courses' => $courses]);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        if($user->save()) return redirect()->route('admin');
        return "Wystąpił błąd.";
    }

    public function deleteuser ($id) {
        // Only for Admins
        if (\Auth::user()->role_id < 3) {
            $courses = UserCourse::whereHas('user', function ($q) {
                $q->where('user_id', '=', \Auth::user()->id);
            })->get();
            return redirect()->route('home', ['courses' => $courses]);
        }
        // Najpierw usuń zapisy na kursy...
        if ($enrolls = UserCourse::where('user_id', $id)) {
            $enrolls->delete();
        }
        // ... i komentarze
        if ($comments = Comment::where('user_id', $id)) {
            $comments->delete();
        }
        // Usuń użytkownika
        $user = User::find($id);
        if($user->delete()) return redirect()->route('admin');
        return "Wystąpił błąd.";
    }
}
