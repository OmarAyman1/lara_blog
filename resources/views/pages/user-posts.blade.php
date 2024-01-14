@extends('layouts.app')

@section('content')


@if (Auth::id() == $user_id)
    <div class="row">
        <div class="centercolumn">
            @if (Session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
            <div class="card">
                <h3>Posts
                    <a href="{{ url('/add-post') }}" class="btn btn-primary float-end"> add post</a>
                </h3>
            </div>
        </div>
    </div>
@endif



<div class="row">
    <div class="centercolumn">

        @forelse ($posts as $post)
            <div class="card">
                <div class="header-container">
                    <div>
                        <a href="{{url('posts/'.$post->id)}}" style="color: rgb(6, 74, 55)"><h2>{{$post->title}}</h2></a>
                        <p>{{$post->body}}</p>
                    </div>

                    @if (Auth::id() == $user_id)
                        <div>
                            <div class="row">
                                <a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                            </div>
                            <br>
                            <div class="row">
                                <a href="{{url('posts/'.$post->id.'/delete')}}" onclick="return confirm('are you sure you want to delete this post')" class="btn btn-sm btn-danger">Delete</a>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="card">
                <h4>No posts found</h4>
            </div>
        @endforelse
    </div>
</div>






  {{-- <div class="footer">
    <h2>Footer</h2>
  </div> --}}
@endsection
