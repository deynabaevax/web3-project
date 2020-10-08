<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PageController extends Controller
{
    public function home(){
        $posts = Post::orderBy('id', 'asc')->paginate(4); 
        return view('inc.mock')->with('posts', $posts);
    }

    public function about(){
        $title = 'About Us';
        return view('aboutMe.aboutMe')->with('title', $title);
    }

    // public function posts(){
    //     return view('pages.posts');
    // }

    public function comments(){
        $title = 'Manage comments';
        return view('pages.comments')->with('title', $title);
    }

}
