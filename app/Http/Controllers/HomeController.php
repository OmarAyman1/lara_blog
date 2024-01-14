<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\BlogPost;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = BlogPost::latest()->take(15)->get();
        return view('pages.index', compact('posts'));
    }

    public function userPosts($user_id){
        $posts = BlogPost::where('user_id', $user_id)->latest()->take(15)->get();
        return view('pages.user-posts', compact('posts', 'user_id'));
    }


}
