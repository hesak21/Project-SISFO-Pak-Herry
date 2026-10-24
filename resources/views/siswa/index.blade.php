@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                        <h5 class="card-title mb-0 fw-bold text-primary">Daftar Data Siswa</h5>
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Data Siswa
                        </a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Kelas</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($siswa as $index => $siswa)
                                        <tr>
                                            <td class="text-center">
                                                {{ method_exists($siswa, 'firstItem') ? $index + $siswa->firstItem() : $index + 1 }}
                                            </td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->nama_lengkap }}</td>
                                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $siswa->jenis_kelamin == 'L' ? 'bg-info text-dark' : 'bg-warning text-dark' }}">
                                                    {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                </span>
                                            </td>
                                            <td>{{ $siswa->no_hp }}</td>
                                            <td>{{ $siswa->alamat }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-info btn-sm text-white" title="Detail">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    
                                                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    
                                                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">Belum ada data siswa yang tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if (isset($siswa) && method_exists($siswa, 'links'))
                            <div class="d-flex justify-content-end mt-3">
                                {{ $siswa->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection