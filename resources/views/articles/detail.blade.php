@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{$article->title}}</h5>

                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                    by
                    <b>{{ $article->user->name }}</b>
                    <br>
                    Category: <b>{{ $article->category->name }}</b>
                </div>

                <p class="card-text">{{$article->body}}</p>

                @if($article->user_id == auth()->id())
                    <a href="{{url("/articles/edit/$article->id")}}" class="btn btn-warning">
                        Edit
                    </a>
                @endif
            </div>
        </div>

        <ul class="list-group mb-2">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    {{ $comment->content }}
                    <a href="{{url("/comments/delete/$comment->id")}}" class="btn-close float-end"></a>

                    <div class="small mt-2">
                        By <b>{{$comment->user->name}}</b>
                        {{$comment->created_at->diffForHumans()}}
                    </div>
                </li>
            @endforeach
        </ul>

        @auth
            <form action="{{url('/comments/add')}}" method="POST">
                @csrf
                <input type="hidden" name="article_id" value="{{$article->id}}">
                <textarea name="content" class="form-control mb-2" rows="5" placeholder="Enter comment ..."></textarea>
                <input type="submit" value="Add Comment" class="btn btn-secondary">
            </form>
        @endauth
    </div>
@endsection
