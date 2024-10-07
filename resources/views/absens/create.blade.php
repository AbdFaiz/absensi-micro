@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Tambah Absen</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('absens.store') }}" method="POST" id="absenForm">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <select class="form-select" id="nama" name="nama" required>
                            <option value="" disabled selected>Pilih Nama</option>
                            @foreach ($namas as $nama)
                                <option value="{{ $nama->id }}">{{ $nama->nama }}</option>
                            @endforeach
                        </select>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="masuk">Masuk</option>
                            <option value="pulang">Pulang</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alfa">Alfa</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('absens.create') }}";
                }
            });
        </script>
    @endif
@endsection
