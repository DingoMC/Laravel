<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class UserCoursesController extends Controller
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
        $courses = UserCourse::whereHas('user', function ($q) {
            $q->where('user_id', '=', \Auth::user()->id);
        })->get();
        $all = Course::orderBy('id', 'asc')->get();
        return view('userCourses', ['mycourses' => $courses, 'all' => $all]);
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
    public function store(Request $request, $id) {
        $userCourse = new UserCourse();
        $userCourse->user_id = \Auth::user()->id;
        $userCourse->course_id = $id;
        if($userCourse->save()) return redirect()->route('mycourses');
        return "Wystąpił błąd.";
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
        $userCourse = UserCourse::find($id);
        if (\Auth::user()->id != $userCourse->user_id) {
            // If Admin
            if (\Auth::user()->role_id == 3) {
                if ($userCourse->delete()) return redirect()->route('admin');
            }
            return back();
        }
        if ($userCourse->delete()) return redirect()->route('mycourses');
        return back();
    }
}
