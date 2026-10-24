<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:guru,nip',
            'nama' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        Guru::create($request->all());

        return redirect('/guru')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nip' => 'required|unique:gurus,nip,'.$id,
            'nama' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        $guru->update($request->all());

        return redirect('/guru')->with('success', 'Data guru berhasil disimpan!');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect('/guru')->with('success', 'Data guru berhasil dihilangkan!');
    }
}