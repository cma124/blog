@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $article->title }}">

                @error('title')
                    <div class="mt-1">
                        <small class="text-danger">{{$message}}</small>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Body</label>
                <textarea name="body" class="form-control" rows="5">{{ $article->body }}</textarea>

                @error('body')
                    <div class="mt-1">
                        <small class="text-danger">{{$message}}</small>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{$category['id']}}" @selected($article->category_id == $category->id)>
                            {{$category['name']}}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <div class="mt-1">
                        <small class="text-danger">{{$message}}</small>
                    </div>
                @enderror
            </div>

            <input type="submit" value="Edit Article" class="btn btn-primary">
        </form>
    </div>
@endsection
