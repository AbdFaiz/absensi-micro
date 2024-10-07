@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Detail Report</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong><i class="fas fa-user"></i> Nama:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="card-text">{{ $report->nama }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong><i class="fas fa-briefcase"></i> Job:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="card-text">{{ $report->job }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong><i class="fas fa-file-alt"></i> Rincian:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="card-text">{{ $report->rincian }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong><i class="fas fa-exclamation-circle"></i> Trouble:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="card-text">{{ $report->trouble ?? 'Tidak ada' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong><i class="fas fa-chart-pie"></i> Persentase:</strong>
                    </div>
                    <div class="col-md-9">
                        <p class="card-text">{{ $report->persentase ?? 'Tidak ada' }}%</p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-bar-left"></i> Back</a>
                </div>
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
            });
        </script>
    @endif
@endsection
