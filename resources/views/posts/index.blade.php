@extends('layouts.app')

@section('content')

{{-- @php
    $commentBody;
    $commentID;
@endphp --}}

<div class="row">
    <div class="centercolumn">
        @if (Session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif
        <div class="card">

                <h4>{{$post->title}}</h4>

            <div class="header-container">
                <div style="display: flex">
                    written by: <a href="{{url('user-posts/'.$post->user->id)}}"><h5 style="margin-left: 5px">{{$post->user->name}}</h5></a>
                </div>
                @if ($post->user->id == Auth::id())
                    <a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                @endif
            </div>
            <div style="display: flex">

                posted at: {{$post->created_at->format(' d/m/Y ')}}
            </div>
            <hr>
            <p>{{$post->body}}</p>
        </div>
    </div>
</div>


<div class="row" id="addComment">
    <div class="centercolumn">
        @if (Auth::check())
            <div class="card">
                <h4>Add Comment</h4>

                <form method="post" action="{{ url('comments/create'   ) }}">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="body"></textarea>
                        @error('body')<small class="text-danger">{{$message}}</small>@enderror
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    </div>
                    <div class="form-group" style="margin-top: 9px">
                        <input type="submit" class="btn btn-success" value="Add Comment" />
                    </div>
                </form>
            </div>
        @else
            <div class="card">
                <h5>Login to comment</h5>
            </div>
        @endif
    </div>
</div>

<div class="row" id="updateComment" hidden>
    <div class="centercolumn">
        @if (Auth::check())
            <div class="card">
                <h4>update Comment</h4>

                <form method="post" action="" id="updateForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="commentArea"></textarea>
                        @error('body')<small class="text-danger">{{$message}}</small>@enderror
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    </div>
                    <div class="form-group" style="margin-top: 9px">
                        <input type="submit" class="btn btn-success" value="Update Comment" />
                    </div>
                </form>
            </div>
        @else
            <div class="card">
                <h5>Login to comment</h5>
            </div>
        @endif
    </div>
</div>


<div class="row">
    <div class="centercolumn">
        <div class="card">

                <h4> Comments</h4>
                <hr>
                @forelse ($post->comments as $comment)
                <div class="header-container">
                    <div style="display: flex">
                        <a href="{{url('user-posts/'.$post->user->id)}}" style="margin-right: 5px"><strong >{{ $comment->user->name }}:  </strong></a>
                        <p>{{ $comment->body }}</p>
                    </div>

                    @if ($comment->user->id == Auth::id())
                    <div style="display: flex">
                        <button type="button" onclick="editComment('{{$comment->body}}', '{{$comment->id}}')" class="btn btn-sm btn-success" style="height: 30px; margin-right:10px"> Edit</button>
                        {{-- <a href="{{url('comments/'.$comment->id.'/edit')}}" class="btn btn-sm btn-success" style="height: 30px; margin-right:10px">Edit</a> --}}
                        <a href="{{url('comments/'.$comment->id.'/delete')}}" onclick="return confirm('are you sure you want to delete this comment?')" class="btn btn-sm btn-danger" style="height: 30px; margin-right:10px">Delete</a>
                    </div>
                    @endif
                </div>

                    <hr>
                @empty
                    No comments found for this post
                @endforelse
        </div>
    </div>
</div>



@endsection


@section('script')
<script>
    function editComment(commentContent, com_id) {
        document.getElementById('commentArea').value = commentContent;
        document.getElementById("addComment").hidden = true;
        document.getElementById("updateComment").hidden = false;

        document.getElementById("commentArea").focus();
        var form = document.getElementById("updateForm");
        form.action = "/comments/"+com_id+"/update";
    }
</script>

@endsection
