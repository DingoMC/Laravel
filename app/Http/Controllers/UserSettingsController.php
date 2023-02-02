<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
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
        return view('userSettings', ['success' => true]);
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
        $user = User::find($id);
        // Sprawdź czy użytkownik o podanej nazwie już istnieje
        $chk_user = User::where('name', $request->name)->first();
        if ($chk_user != null) {
            if ($chk_user->name == $request->name) return back()->with(['success' => false, 'message_type' => 'danger', 'message' => 'Podana nazwa użytkownika jest już zajęta.']);
        }
        $user->name = $request->name;
        if($user->save()) return redirect()->route('home');
        return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->id != $id) return redirect()->route('home');
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
        $user->delete();
        return redirect()->route('register');
    }

    /**
     * Remove all comments posted by specific user
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAllComments ($id) {
        if (\Auth::user()->id != $id) return redirect()->route('home');
        if ($comments = Comment::where('user_id', $id)) {
            $comments->delete();
        }
        return redirect()->route('home');
    }

    /**
     * Remove specific user from all courses
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function leaveAllCourses ($id) {
        if (\Auth::user()->id != $id) return redirect()->route('home');
        if ($enrolls = UserCourse::where('user_id', $id)) {
            $enrolls->delete();
        }
        return redirect()->route('home');
    }
}
