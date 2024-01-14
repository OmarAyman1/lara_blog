@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-md-12 grid-margin">
        @if (Session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif
        <div class="card">
            <div class="card-header">
                <h3>Update Post
                    <a href="{{ url('user-posts/'.$post->user->id) }}" class="btn btn-primary float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
            <form action="{{ url('posts/'.$post->id.'/update') }}" method="POST" >
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $post->title }}" class="form-control"/>
                            @error('title')<small class="text-danger">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Content</label>
                            <textarea name="body" class="form-control" >{{ $post->body }}</textarea>
                            @error('body')<small class="text-danger">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection
