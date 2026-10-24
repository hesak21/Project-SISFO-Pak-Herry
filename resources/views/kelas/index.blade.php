@extends('layouts.main')

@section('title', 'Data Kelas')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                        <h5 class="card-title mb-0 fw-bold text-primary">Daftar Data Kelas</h5>
                        <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Data Kelas
                        </a>
                    </div>
                    <div class="card-body">
                        {{-- Tampilkan Pesan Sukses (Flash Message) --}}
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
                                        <th>Nama Kelas</th>
                                        <th class="text-center">Tingkat</th>
                                        <th>Jurusan</th>
                                        <th>Tahun Ajaran</th>
                                        <th class="text-center">Jumlah Siswa</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kelas as $index => $kelas)
                                        <tr>
                                            <td class="text-center">
                                                {{ method_exists($kelases, 'firstItem') ? $index + $kelases->firstItem() : $index + 1 }}
                                            </td>
                                            <td>{{ $kelas->nama_kelas }}</td>
                                            <td class="text-center">{{ $kelas->tingkat }}</td>
                                            <td>{{ $kelas->jurusan }}</td>
                                            <td>{{ $kelas->tahun_ajaran }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary">{{ $kelas->jumlah_siswa ?? 0 }} Siswa</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    
                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                                            <td colspan="7" class="text-center text-muted py-4">Belum ada data kelas yang tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Navigasi Paging (Jika menggunakan pagination controller) --}}
                        @if (isset($kelases) && method_exists($kelases, 'links'))
                            <div class="d-flex justify-content-end mt-3">
                                {{ $kelases->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection