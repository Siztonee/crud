@extends('layouts.admin')

@section('content')
    <div>
        <div>
            <a class="btn btn-success mb-3" href="{{ route('post.create') }}">Add Post</a>
        </div>
        @foreach($posts as $post)
            <div class="mt-1">
                <a href="{{ route('post.show', $post->id) }}">{{ $post->id }}. {{ $post->title }}</a>
            </div>
        @endforeach

        <div class="mt-5">
            {{ $posts->withQueryString()->links() }}
        </div>
    </div>
@endsection
