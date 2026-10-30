<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('kelas')->get();
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'nis'           => 'required|unique:siswas,nis|max:20',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:15',
            'kelas_id'      => 'required|exists:kelas,id',
        ]);

        Siswa::create($validatedData);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load(['kelas', 'nilais.mapel']);
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validatedData = $request->validate([
            'nis'           => 'required|max:20|unique:siswas,nis,' . $siswa->id,
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:15',
            'kelas_id'      => 'required|exists:kelas,id',
        ]);

        $siswa->update($validatedData);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}