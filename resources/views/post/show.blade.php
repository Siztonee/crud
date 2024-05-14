@extends('layouts.main')
@section('content')

    <div class="mb-3">
        <div>
            <span class="font-monospace">Post ID: </span>{{ $post->id }} <br>
            <span class="font-monospace">Title: </span>{{ $post->title }}
        </div>
        <div><span class="font-monospace">Text: </span>{{ $post->content }}</div>
    </div>
    <div class="d-flex">
        <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('post.edit', $post->id) }}">Edit</a>
        </div>
        <div class="mb-3 ps-2">
            <form action="{{ route('post.delete', $post->id) }}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
        <div class="mb-3 ps-2">
            <a class="btn btn-secondary" href="{{ route('post.index') }}">Back</a>
        </div>
    </div>
@endsection
