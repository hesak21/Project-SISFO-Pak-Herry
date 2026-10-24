@extends('layouts.main')

@section('title', 'Detail Data Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Profil Siswa</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 32px;">
                                {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
                            </div>
                            <h5 class="mt-2 mb-0 fw-bold">{{ $siswa->nama_lengkap }}</h5>
                            <p class="text-muted">NIS: {{ $siswa->nis }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-semibold">Kelas</span>
                                <span>{{ $siswa->kelas->nama_kelas ?? '-' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-semibold">Jenis Kelamin</span>
                                <span>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-semibold">No. HP</span>
                                <span>{{ $siswa->no_hp ?? '-' }}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="fw-semibold d-block mb-1">Alamat</span>
                                <span class="text-muted">{{ $siswa->alamat ?? '-' }}</span>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary w-100">Kembali ke Daftar Siswa</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0 fw-bold text-primary">Riwayat Nilai Mata Pelajaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Mata Pelajaran</th>
                                        <th class="text-center">Nilai Tugas</th>
                                        <th class="text-center">Nilai UTS</th>
                                        <th class="text-center">Nilai UAS</th>
                                        <th class="text-center">Rata-rata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($siswa->nilais ?? [] as $index => $nilai)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $nilai->mapel->nama_mapel ?? '-' }}</td>
                                            <td class="text-center">{{ $nilai->nilai_tugas }}</td>
                                            <td class="text-center">{{ $nilai->nilai_uts }}</td>
                                            <td class="text-center">{{ $nilai->nilai_uas }}</td>
                                            <td class="text-center">
                                                @php
                                                    $rataRata = ($nilai->nilai_tugas + $nilai->nilai_uts + $nilai->nilai_uas) / 3;
                                                @endphp
                                                <span class="badge bg-success">{{ number_format($rataRata, 2) }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat nilai untuk siswa ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection