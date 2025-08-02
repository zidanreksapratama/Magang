@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Berita</h2>
    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $news->title }}" required>
        </div>
        <div class="mb-3">
            <label>Isi</label>
            <textarea name="content" class="form-control" required>{{ $news->content }}</textarea>
        </div>
        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>
            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="Gambar" width="150">
            @else
                <p><em>Belum ada gambar</em></p>
            @endif
        </div>
        <div class="mb-3">
            <label>Ganti Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection