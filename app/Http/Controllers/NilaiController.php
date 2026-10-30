<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with(['siswa.kelas', 'mapel'])->get();
        return view('nilai.index', compact('nilai'));
    }

    public function create()
    {
        $siswa= Siswa::all();$mapel= Mapel::all();
        return view('nilai.create', compact('siswa', 'mapel'));
    }

    public function store(Request $request)
    {
        $validatedData =$request->validate([
            'siswa_id'    => 'required|exists:siswa,id',
            'mapel_id'    => 'required|exists:mapel,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts'   => 'required|numeric|min:0|max:100',
            'nilai_uas'   => 'required|numeric|min:0|max:100',
        ]);

        $nilaiAkhir = ($validatedData['nilai_tugas'] * 0.3) + ($validatedData['nilai_uts'] * 0.3) + ($validatedData['nilai_uas'] * 0.4);

        $kkm = 75;
        $keterangan = $nilaiAkhir >=$kkm ? 'Lulus' : 'Tidak Lulus';
        $validatedData['nilai_akhir'] =$nilaiAkhir;
        $validatedData['keterangan'] =$keterangan;

        Nilai::create($validatedData);
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai)
    {
        $siswa = Siswa::all();
        $mapel = Mapel::all();
    
        return view('nilai.edit', compact('nilai', 'siswa', 'mapel'));
    }

    public function update(Request $request, Nilai$nilai)
    {
        $validatedData =$request->validate([
            'siswa_id'    => 'required|exists:siswa,id',
            'mapel_id'    => 'required|exists:mapel,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts'   => 'required|numeric|min:0|max:100',
            'nilai_uas'   => 'required|numeric|min:0|max:100',
        ]);

        $nilaiAkhir = ($validatedData['nilai_tugas'] * 0.3) + ($validatedData['nilai_uts'] * 0.3) + ($validatedData['nilai_uas'] * 0.4);

        $kkm = 75;
        $keterangan = $nilaiAkhir >=$kkm ? 'Lulus' : 'Tidak Lulus';

        $validatedData['nilai_akhir'] =$nilaiAkhir;
        $validatedData['keterangan'] =$keterangan;

        $nilai->update($validatedData);
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil sisimpan');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }
}