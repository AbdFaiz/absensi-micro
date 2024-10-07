<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class ReportController extends Controller
{
    // Menampilkan form untuk membuat report
    public function create()
    {
        return view('reports.create');
    }

    // Menyimpan report yang dibuat oleh pengguna
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'job' => 'required|string',
            'rincian' => 'required|string',
            'trouble' => 'nullable|string',
            'persentase' => 'nullable|integer|min:0|max:100',
        ]);

        // Menyimpan data report
        $report = new Report();
        $report->nama = $request->nama;
        $report->job = $request->job;
        $report->rincian = $request->rincian;
        $report->trouble = $request->trouble;
        $report->persentase = $request->persentase;
        $report->tanggal = Date::now();
        $report->save();

        // Redirect ke form create dengan pesan sukses
        return redirect()->route('reports.create')->with('success', 'Report created successfully.');
    }

    // Menampilkan daftar report (hanya untuk admin)
    public function index(Request $request)
    {
        $query = Report::query();

        $tanggal = $request->input('tanggal', now()->toDateString());
        $query->whereDate('tanggal', $tanggal);

        if (Auth::user()->role == 'admin') {
            $reports = $query->get(); // Dapatkan report yang telah difilter
            return view('reports.index', compact('reports', 'tanggal')); // Kirim tanggal default ke view
        }

        // Jika pengguna bukan admin, redirect ke halaman lain
        return redirect()->route('reports.create');
    }




    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }

}
