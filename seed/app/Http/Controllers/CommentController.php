<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use Validator;

use Illuminate\Support\Facades\Storage;
use DB;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    public function index()
    {
        $user = auth()->user();
        return view('pages.comments')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post_id)
    {
        $this->validate($request, [
            'comment' => 'max:500',
        ]);

        $post= Post::find($post_id);
        
        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->post_id = $post_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->route('posts.show', [$post->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('pages.edit')->withComment($comment);
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
        $comment = Comment::find($id);

        $this->validate($request, array('comment' => 'required'));

        $rules=['comment' => 'required'];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){return response()->json($validator->errors(), 400);}
        
        $comment->comment = $request->comment;
        $comment->save();

        response()->json($comment, 200);
        return redirect()->route('posts.show', $comment->post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        $post_id = $comment->post->id;
        $comment->delete();

        response()->json(null, 204);
        return redirect()->route('posts.show', $post_id)->with('success', 'Comment Deleted!');
    }
}
