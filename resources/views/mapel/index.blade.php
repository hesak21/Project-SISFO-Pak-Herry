@extends('layouts.main')
 
@section('title', 'Data Mata Pelajaran')
 
@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Data Mata Pelajaran</h6>
                <a href="{{ route('mapel.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Data Mapel
                </a>
            </div>
 
            <div class="card-body">
 
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th>Kode Mapel</th>
                                <th>Nama Mapel</th>
                                <th class="text-center">KKM</th>
                                <th class="text-center" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mapel as $m)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $m->kode_mapel }}</td>
                                    <td>{{ $m->nama_mapel }}</td>
                                    <td class="text-center">{{ $m->kkm }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('mapel.edit', $m->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('mapel.destroy', $m->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada data mata pelajaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
 