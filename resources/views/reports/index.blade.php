@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Report</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('reports.index') }}" id="filter-form">
            <div class="form-group">
                <label for="tanggal">Pilih Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" onchange="this.form.submit()"
                    value="{{ request('tanggal', $tanggal) }}"> <!-- Set tanggal default -->
            </div>
        </form>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Job</th>
                    <th>Rincian</th>
                    <th>Trouble</th>
                    <th>Persentase</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="report-table-body">
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->nama }}</td>
                        <td>{{ $report->job }}</td>
                        <td>{{ $report->rincian }}</td>
                        <td>{{ $report->trouble }}</td>
                        <td>{{ $report->persentase }}</td>
                        <td>{{ $report->tanggal }}</td>
                        <td>
                            <a href="{{ route('reports.show', $report->id) }}" class="btn btn-outline-primary"><i
                                    class="bi bi-ticket-detailed me-1"></i>Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
