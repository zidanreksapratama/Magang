@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Tenan Company</h2>

    <form action="{{ route('tenan.update', $tenant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Perusahaan</label>
            <input type="text" id="name" name="name" value="{{ old('name', $tenant->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Perusahaan</label>
            <input type="email" id="email" name="email" value="{{ old('email', $tenant->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-control" required>{{ old('alamat', $tenant->alamat) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tenan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection