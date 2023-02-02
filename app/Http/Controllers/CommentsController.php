<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
	    $comments = Comment::orderBy('created_at', 'desc')->get();
        return view('comments', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (\Auth::user() == null) {
            $comments = Comment::orderBy('created_at', 'desc')->get();
            return redirect()->route('comments', ['comments' => $comments]);
        }
        $enrolled_courses = UserCourse::whereHas('user', function ($q) {
            $q->where('user_id', '=', \Auth::user()->id);
        })->get();
        $commented_courses = Comment::whereHas('user', function ($q) {
            $q->where('user_id', '=', \Auth::user()->id);
        })->get();
        $comment = new Comment;
	    return view('commentsForm', ['comment' => $comment, 'enrolled' => $enrolled_courses, 'commented' => $commented_courses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'message' => 'required|min:10|max:255',
            'cselect' => 'required'
        ]);
        if (\Auth::user() == null) return view('home');
        $comment = new Comment();
        $comment->user_id = \Auth::user()->id;
        $comment->course_id = $request->cselect;
        $comment->message = $request->message;
        if ($comment->save()) return redirect('comments');
        return view('comments');
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
    public function edit ($id) {
        if (\Auth::user() == null) {
            $comments = Comment::orderBy('created_at', 'desc')->get();
            return redirect()->route('comments', ['comments' => $comments]);
        }
        $comment = Comment::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if (\Auth::user()->id != $comment->user_id) return back()->with(['success' => false, 'message_type' => 'danger', 'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        return view('commentsEditForm', ['comment'=>$comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $comment = Comment::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if(\Auth::user()->id != $comment->user_id) return back()->with(['success' => false, 'message_type' => 'danger', 'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        $comment->message = $request->message;
        if($comment->save()) return redirect()->route('comments');
        return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (\Auth::user() == null) {
            $comments = Comment::orderBy('created_at', 'desc')->get();
            return redirect()->route('comments', ['comments' => $comments]);
        }
        $comment = Comment::find($id);
        if (\Auth::user()->id != $comment->user_id && \Auth::user()->role_id <= $comment->user->role_id) return back();
        if ($comment->delete()) return redirect()->route('comments');
        return back();
    }
}
