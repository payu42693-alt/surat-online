<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    // MAHASISWA: melihat surat miliknya
    public function index()
    {
        $surats = Surat::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('mahasiswa.surat.index', compact('surats'));
    }

    // MAHASISWA: form pengajuan
    public function create()
    {
        return view('mahasiswa.surat.create');
    }

    // MAHASISWA: menyimpan pengajuan
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'keperluan' => 'required',
        ]);

        Surat::create([
            'user_id' => auth()->id(),
            'jenis_surat' => $request->jenis_surat,
            'keperluan' => $request->keperluan,
            'status' => 'diajukan',
        ]);

        return redirect()
            ->route('mahasiswa.surat.index')
            ->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    // MAHASISWA: melihat detail surat
    public function show($id)
    {
        $surat = Surat::findOrFail($id);

        // PEMERIKSAAN KEPEMILIKAN
        if ($surat->user_id !== auth()->id()) {
            abort(403, 'FORBIDDEN');
        }

        return view('mahasiswa.surat.show', compact('surat'));
    }

    // PETUGAS: melihat semua pengajuan
    public function petugas()
    {
        $surats = Surat::with('user')
            ->latest()
            ->get();

        return view('petugas.surat.index', compact('surats'));
    }

    // PETUGAS: memproses surat
    public function proses($id)
    {
        $surat = Surat::findOrFail($id);

        $surat->update([
            'status' => 'diproses',
        ]);

        return redirect()
            ->route('petugas.surat.index')
            ->with('success', 'Pengajuan berhasil diproses.');
    }

    // KEPALA BAGIAN: melihat pengajuan
    public function kepalaBagian()
    {
        $surats = Surat::with('user')
            ->where('status', 'diproses')
            ->latest()
            ->get();

        return view('kepala_bagian.surat.index', compact('surats'));
    }

    // KEPALA BAGIAN: menyetujui
    public function setujui($id)
    {
        $surat = Surat::findOrFail($id);

        $surat->update([
            'status' => 'disetujui',
        ]);

        return redirect()
            ->route('kepala.surat.index')
            ->with('success', 'Pengajuan disetujui.');
    }

    // KEPALA BAGIAN: menolak
    public function tolak($id)
    {
        $surat = Surat::findOrFail($id);

        $surat->update([
            'status' => 'ditolak',
        ]);

        return redirect()
            ->route('kepala.surat.index')
            ->with('success', 'Pengajuan ditolak.');
    }
}