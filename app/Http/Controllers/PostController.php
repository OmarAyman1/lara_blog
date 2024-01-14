<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index($post_id){
        $post = BlogPost::findOrFail($post_id);
        return view('posts.index', compact('post'));
    }

    public function create(){
        if(Auth::check()){
            return view('posts.create');
        }else{
            return redirect('/')->with('message', 'you are not allowed to add');
        }
    }

    public function store(PostFormRequest $request)
    {
        $validatedData = $request->validated();

        $userId = Auth::id();
        $post = new BlogPost;
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->user_id = $userId;
        $post->save();
        return redirect('user-posts/'.$userId)->with('message', 'post added');
    }

    public function edit($post_id){
        $post = BlogPost::findOrFail($post_id);
        $userId = Auth::id();
        if($post->user_id == $userId){
            return view('posts.edit', compact('post'));
        }else{
            return redirect('/')->with('message', 'you are not allowed to update this post');
        }
    }

    public function destroy($post_id){
        $post = BlogPost::findOrFail($post_id);
        $userId = Auth::id();
        if($post->user_id == $userId){
            $post->comments()->delete();
            $post->delete();

            return redirect()->back()->with('message', 'post deleted succesfully');
        }else{
            return redirect('/')->with('message', 'you are not allowed to delete this post');
        }
    }

    public function update(PostFormRequest $request, int $post_id){
        $validatedData = $request->validated();
        $post = BlogPost::findOrFail($post_id);
        $userId = Auth::id();
        if($post){
            if($post->user_id == $userId){
                $post->update([
                    'title'=> $validatedData['title'],
                    'body'=> $validatedData['body'],
                ]);

                return redirect('user-posts/'.$userId)->with('message', 'post updated succesfully');
            }else{
                return redirect('/')->with('message', 'you are not allowed to update this post');
            }
        }else{
            return redirect('/')->with('message', "no post found for id");
        }
    }
}
