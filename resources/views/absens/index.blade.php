@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col justify-content-start">
                <h2>Data Absensi</h2>
            </div>
            <div class="col justify-content-end text-end">
                <a href="{{ route('absens.create') }}" class="btn btn-outline-primary"><i
                        class="bi bi-plus-circle me-1 mt-2"></i>Tambah
                    Absensi</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Form -->
        <form method="GET" action="{{ route('absens.index') }}" class="mt-3">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tanggal">Filter Tanggal:</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                        value="{{ request('tanggal') ?? $tanggal }}">
                </div>
                <div class="col-md-5">
                    <label for="status">Filter Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">No Filter</option>
                        <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="alfa" {{ request('status') == 'alfa' ? 'selected' : '' }}>Alfa</option>
                    </select>
                </div>
                <div class="col-md-1 mt-4 text-end">
                    <button type="submit" class="btn btn-outline-success">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absens as $absen)
                    <tr>
                        <td>{{ ucwords($absen->nama->nama) }}</td>
                        <td>{{ ucfirst($absen->status) }}</td>
                        <td>{{ $absen->tanggal }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-info me-1" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $absen->id }}">
                                <i class="bi bi-pen me-1"></i>Edit
                            </button>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $absen->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $absen->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $absen->id }}">Edit Absensi
                                            </h5>
                                            <button type="button" class="btn-outline-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('absens.update', $absen->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="nama{{ $absen->id }}">Nama:</label>
                                                    <select name="nama" id="nama{{ $absen->id }}"
                                                        class="form-select">
                                                        @foreach ($namas as $nama)
                                                            <option value="{{ $nama->id }}"
                                                                {{ $absen->nama->id == $nama->id ? 'selected' : '' }}>
                                                                {{ $nama->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status{{ $absen->id }}">Status:</label>
                                                    <select name="status" id="status{{ $absen->id }}"
                                                        class="form-select">
                                                        <option value="masuk"
                                                            {{ $absen->status == 'masuk' ? 'selected' : '' }}>Masuk
                                                        </option>
                                                        <option value="pulang"
                                                            {{ $absen->status == 'pulang' ? 'selected' : '' }}>Pulang
                                                        </option>
                                                        <option value="sakit"
                                                            {{ $absen->status == 'sakit' ? 'selected' : '' }}>Sakit
                                                        </option>
                                                        <option value="izin"
                                                            {{ $absen->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                                        <option value="alfa"
                                                            {{ $absen->status == 'alfa' ? 'selected' : '' }}>Alfa</option>
                                                    </select>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-primary">Update</button>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Delete button with SweetAlert --}}
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $absen->id }}">
                                <i class="bi bi-trash me-1"></i>Hapus
                            </button>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $absen->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $absen->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel{{ $absen->id }}">Hapus
                                                data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('absens.destroy', $absen->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
