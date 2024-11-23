@extends('layouts.app')

@section('title', "Judul: $post->title")

@section('content')
    <article class="blog-post">
        <h2 class="blog-post-title mb-1">{{ $post->title }}</h2>
        <p class="blog-post-meta">{{ date("d M Y H:i", strtotime($post->created_at))}}</p>
        <p>{{ $post->content }}</p>

        <small class="text-secondary fw-bold">{{ $total_comments }} komentar netizen</small>
        @foreach ($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <small>{{ $comment->comment }}</small>
                </div>
            </div>
        @endforeach
    </article>
    <a href="{{ url("posts") }}" class="btn btn-success">Kembali</a>
@endsection