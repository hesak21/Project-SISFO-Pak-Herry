@extends('layouts.main')

@section('title', 'Data Guru')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                        <h5 class="card-title mb-0 fw-bold text-primary">Daftar Data Guru</h5>
                        <a href="{{ route('guru.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Data Guru
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
                                        <th>NIP</th>
                                        <th>Nama Lengkap</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guru as $index => $guru)
                                        <tr>
                                            <td class="text-center">
                                                {{ method_exists($guru, 'firstItem') ? $index + $guru->firstItem() : $index + 1 }}
                                            </td>
                                            <td>{{ $guru->nip }}</td>
                                            <td>{{ $guru->nama }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $guru->jenis_kelamin == 'L' ? 'bg-info text-dark' : 'bg-warning text-dark' }}">
                                                    {{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                </span>
                                            </td>
                                            <td>{{ $guru->email }}</td>
                                            <td>{{ $guru->no_hp }}</td>
                                            <td>{{ $guru->alamat }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    
                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                                            <td colspan="8" class="text-center text-muted py-4">Belum ada data guru yang tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Navigasi Paging (Jika menggunakan pagination controller) --}}
                        @if (isset($guru) && method_exists($guru, 'link'))
                            <div class="d-flex justify-content-end mt-3">
                                {{ $guru->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection