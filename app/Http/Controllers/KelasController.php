<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::withCount('siswa')->get();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kelas'   => 'required|string|max:100',
            'tingkat'      => 'required|string|max:10',
            'jurusan'      => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        Kelas::create($validatedData);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validatedData = $request->validate([
            'nama_kelas'   => 'required|string|max:100',
            'tingkat'      => 'required|string|max:10',
            'jurusan'      => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        $kelas->update($validatedData);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diapus.');
    }
}