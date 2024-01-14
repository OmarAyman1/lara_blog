@extends('layouts.app')

@section('content')

<div class="row">
    <div class="centercolumn">
        @forelse ($posts as $post)
            <div class="card">
                <div class="header-container">
                    <a href="{{url('posts/'.$post->id)}}" style="color: rgb(6, 74, 55)"><h2>{{$post->title}}</h2></a>
                    <a href="{{url('user-posts/'.$post->user->id)}}"><h5>{{$post->user->name}}</h5></a>
                  </div>
                <p>{{$post->body}}</p>
            </div>
        @empty
            <div class="card">
                <h4>No Posts available</h4>
            </div>
        @endforelse
    </div>

</div>

@endsection
