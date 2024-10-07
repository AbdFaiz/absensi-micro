<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Nama;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class AbsenController extends Controller
{
    // Menampilkan daftar absensi (hanya untuk admin)
    public function index(Request $request)
    {
        $defaultTanggal = Carbon::today()->toDateString();

        $tanggal = $request->filled('tanggal') ? $request->tanggal : $defaultTanggal;

        $query = Absen::whereIn('status', ['sakit', 'izin', 'alfa']);

        // Filter berdasarkan tanggal
        $query->where('tanggal', $tanggal);

        // Filter berdasarkan status jika ada
        if ($request->filled('status') && in_array($request->status, ['sakit', 'izin', 'alfa'])) {
            $query->where('status', $request->status);
        }

        $absens = $query->get();
        $namas = Nama::all();

        return view('absens.index', compact('absens', 'namas', 'tanggal'));
    }



    // Menampilkan form untuk membuat absensi
    public function create()
    {
        // Ambil semua nama dari tabel namas
        $namas = Nama::all();

        // Kirim data nama ke view
        return view('absens.create', compact('namas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|exists:namas,id',
            'status' => 'required|in:masuk,pulang,sakit,izin,alfa',
        ]);

        $absen = new Absen();
        $absen->nama_id = $request->nama;
        $absen->status = $request->status;
        $absen->tanggal = now();
        $absen->save();

        return redirect()->route('absens.create')->with('success', 'Absen recorded successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|exists:namas,id',
            'status' => 'required|in:masuk,pulang,sakit,izin,alfa',
        ]);

        $absen = Absen::findOrFail($id);
        $absen->nama_id = $request->nama;
        $absen->status = $request->status;
        $absen->save();

        return redirect()->back()->with('status', 'Berhasil update data');
    }

    public function destroy($id)
    {
        // Hapus data absensi
        Absen::destroy($id);
        return redirect()->back()->with('status', 'Berhasil hapus data');
    }
}
