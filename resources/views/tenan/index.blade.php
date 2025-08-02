@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tenan.css') }}">

<div class="tenan-container">
    <div class="tenan-header">
        <h2 class="title">Daftar Tenan</h2>
        <a href="{{ route('tenant.create') }}" class="btn-daftar">Daftar</a>
    </div>

    <div class="table-container">
        <table class="tenan-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenants as $tenan)
                <tr>
                    <td>{{ $tenan->name }}</td>
                    <td>{{ $tenan->email }}</td>
                    <td>{{ $tenan->address }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('tenant.edit', $tenan->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('tenant.destroy', $tenan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty-text">Data Tenan belum tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection