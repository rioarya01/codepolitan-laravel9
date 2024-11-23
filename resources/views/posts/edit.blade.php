@extends('layouts.app')

@section('title', 'Ubah Postingan')

@section('content')
    <h1>Ubah Postingan</h1>
    <form method="POST" action="{{ url("posts/$post->id") }}" class="form-control">
        @method('PATCH')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea class="form-control" rows="3" id="content" name="content">{{$post->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <form method="POST" action="{{ url("posts/$post->id") }}">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
@endsection