<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Validator;
use App\User;
use App\Comment;
use DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(4); 
        response()->json(Post::get(), 200);  
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:2002',
        ]);
        
        $rules=[
            'title' => 'required|min:3',
            'body'=>'required|min:3',
            'cover_image' => 'image|nullable|max:1999',
        ];        

        // Handle the file 
        if($request->hasFile('cover_image')){
            // Get file with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }    

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){return response()->json($validator->errors(), 400);}

        // Create post
        $post = new Post;
        $post->title = $request['title'];
        $post->body = $request['body'];
        $post->cover_image = $fileNameToStore;
        $post->save();
       
        response()->json($post, 201);
        return redirect('/posts')->with('success', 'Post Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)           
    {
        $post = Post::find($id);
        if(is_null($post)){return response()->json(["message"=>"Record Not Found!"], 404);}
        response()->json(Post::find($id), 200);
        
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->authorize('create', Post::class);
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
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
        $this->authorize('create', Post::class);

        $post = Post::find($id);
        if(is_null($post)){return response()->json(["message"=>"Record Not Found!"], 404);}

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:2002'
        ]);

        $rules=[
            'title' => 'required|min:3',
            'body'=>'required|min:3',
            'cover_image' => 'image|nullable|max:2001'
        ];

         // Handle the file 
         if($request->hasFile('cover_image')){
            // Get file with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }   

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){return response()->json($validator->errors(), 400);}
        
        // Create post
        $post->update($request->all());
        response()->json($post, 200);
        // return redirect('/posts')->with(response()->json($post, 200));
        return redirect('/posts')->with('success', 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)            
    {
        $post = Post::find($id);
        if(is_null($post)){return response()->json(["message"=>"Record Not Found!"], 404);}
        $this->authorize('delete', $post);

        if($post->cover_image != 'noimage.jpg' && $post->cover_image != 'img1.jpg'
        && $post->cover_image != 'img2.jpg'&& $post->cover_image != 'img3.jpg'
        && $post->cover_image != 'img4.jpg'){            
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
       
        $post->delete();
        response()->json(null, 204);

        return redirect('/posts')->with('success', 'Post Deleted!');
    }

    public function downloadPDF($id) {
        $post = Post::find($id);
        $dompdf = PDF::loadView('pages.pdf', compact('post'));
        return $dompdf->setPaper('a4')->stream('post');
    }

    public function search()
    {
         request()->validate([
             'query' => 'required|min:2'
         ]);
        $search_text = $_GET['query'];
        $postsSearched = Post::where('title', 'LIKE', '%'.$search_text.'%')->get();
         $q = request()->input('query');

        return view('posts.search', compact('postsSearched'));
    }
}
