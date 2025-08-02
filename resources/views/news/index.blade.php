@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tenan/tenan.css') }}">

<div class="tenan-container">
    <div class="tenan-header">
        <h2 class="title">Daftar Berita</h2>
        <a href="{{ route('news.create') }}" class="btn-daftar">Tambah Berita</a>
    </div>

    <div class="table-container">
        <table class="tenan-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Konten Singkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $n)
                <tr>
                    <td>{{ $n->title }}</td>
                    <td>{{ Str::limit($n->content, 100) }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('news.edit', $n->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('news.destroy', $n->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')" class="form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty-text">Belum ada berita tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection