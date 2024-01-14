<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentFormRequest;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentFormRequest $request)
    {
        $validatedData = $request->validated();
        $userId = Auth::id();
        $comment = new PostComment;
        $comment->body = $validatedData['body'];
        $comment->user_id = $userId;
        $comment->post_id = $request['post_id'];
        // $input['user_id'] = auth()->user()->id;

        // PostComment::create($input);
        $comment->save();
        return back()->with('message', 'comment added successfully');
    }



    public function destroy($comment_id){
        $comment = PostComment::findOrFail($comment_id);
        $userId = Auth::id();
        if($comment->user_id == $userId){
            $comment->delete();
            return back()->with('message', 'comment deleted successfully');
        }else{
            return redirect('/')->with('message', 'you are not allowed to delete this comment');
        }
    }

    public function update(CommentFormRequest $request, int $comment_id){
        $validatedData = $request->validated();
        $comment = PostComment::findOrFail($comment_id);
        $userId = Auth::id();
        if($comment){
            if($comment->user_id == $userId){
                $comment->update([
                    'body'=> $validatedData['body'],
                ]);

                return back()->with('message', 'comment updated succesfully');

                // return redirect('posts.index/'.$comment->post->id)->with('message', 'comment updated succesfully');
            }else{
                return redirect('/')->with('message', 'you are not allowed to update this comment');
            }
        }else{
            return redirect('/')->with('message', "no comment found for id");
        }
    }
}
