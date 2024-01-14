@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if (Session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif
        <div class="card">
            <div class="card-header">
                <h3>Add Post
                    <a href="{{ url('user-posts/'.Auth::id()) }}" class="btn btn-primary float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
            <form action="{{ url('posts/create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control"/>
                            @error('title')<small class="text-danger">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Content</label>
                            <textarea name="body" class="form-control" >{{ old('body') }}</textarea>
                            @error('body')<small class="text-danger">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection
