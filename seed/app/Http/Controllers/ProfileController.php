<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('create', Post::class);
        $users = User::orderBy('created_at', 'desc')->paginate(5); 
        return view('profile.index')->with('users', $users);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        response()->json(User::find($id), 200);

        return view('profile.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user_2 = auth()->user();
        $this->authorize('edit-profile', $user, $user_2);
        return view('profile.edit')->with('user', $user);                
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'bio' => 'max:500',            
        ]);      

         // Handle the file 
         if($request->hasFile('prof_pic')){
            // Get file with extension
            $fileNameWithExt = $request->file('prof_pic')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('prof_pic')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('prof_pic')->storeAs('public/profile_pictures', $fileNameToStore);
        }   

        $rules=[
            'name' => 'required|min:3',
            'bio' => 'max:499',
        ];

        // update user
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->job = $request->input('job');
        $user->bio = $request->input('bio');
        $user->tel = $request->input('tel');
        if($request->hasFile('prof_pic')){
            $user->prof_pic = $fileNameToStore;
        }

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){return response()->json($validator->errors(), 400);}

        $user->save();
        //response()->json($user, 200);
        return redirect('/profile/home')->with('success', 'User Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user_2 = auth()->user();
        $this->authorize('edit-profile', $user, $user_2);


        if($user->prof_pic != 'noimage.jpg' && $user->prof_pic != 'janedoe.jpg'){
            Storage::delete('public/profile_pictures/'.$user->prof_pic);
        }

        $user->delete();
        response()->json(null, 204);
        return redirect('/home')->with('success', 'User Deleted!');
    }
}
