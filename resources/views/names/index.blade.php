@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Nama</h1>
        <a href="{{ route('names.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle me-1"></i>Tambah Nama</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($names as $name)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $name->name }}</td>
                        <td>
                            <a href="{{ route('names.edit', $name->id) }}" class="btn btn-warning">
                                <i class="bi bi-pen me-1"></i>Edit</a>
                            <form action="{{ route('names.destroy', $name->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
