@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Report Kerjaan</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('reports.store') }}" method="POST" id="reportForm">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukkan Nama" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="job" class="form-label">Job</label>
                            <input type="text" class="form-control" id="job" name="job"
                                placeholder="Masukkan Job" required>
                            @error('job')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rincian" class="form-label">Rincian</label>
                            <textarea class="form-control" id="rincian" name="rincian" placeholder="Detail pekerjaan" rows="8" required></textarea>
                            @error('rincian')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="trouble" class="form-label">Trouble (optional)</label>
                            <textarea class="form-control" id="trouble" name="trouble" rows="8"
                                placeholder="Masalah yang dihadapi (jangan masalah hidup)"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="persentase" class="form-label">Persentase (0-100)</label>
                        <div class="d-flex align-items-center">
                            <input type="range" class="form-range me-2" id="persentase" name="persentase" min="0"
                                max="100" value="0" oninput="this.nextElementSibling.value = this.value">
                            <output>0</output>%
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="w-50 text-center">
                            <button type="submit" class="btn btn-outline-primary w-100">Submit</button>
                        </div>
                    </div>
                    
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
                    window.location.href = "{{ route('reports.create') }}"; // Redirect after closing SweetAlert
                }
            });
        </script>
    @endif
@endsection
