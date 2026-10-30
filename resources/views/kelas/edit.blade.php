@extends('layouts.main')

@section('title', 'Tambah Data Kelas')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Tambah Data Kelas</h5>
                    </div>
                    <div class="card-body">
                        {{-- Tampilkan Pesan Error Validasi Umum (Opsional) --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Nama Kelas --}}
                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" placeholder="Contoh: X IPA 1 / X RPL 1" required>
                                @error('nama_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tingkat --}}
                            <div class="mb-3">
                                <label for="tingkat" class="form-label">Tingkat</label>
                                <select class="form-select @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat" required>
                                    <option value="" disabled selected>Pilih Tingkat</option>
                                    <option value="10" {{ old('tingkat') == '10' ? 'selected' : '' }}>X (10)</option>
                                    <option value="11" {{ old('tingkat') == '11' ? 'selected' : '' }}>XI (11)</option>
                                    <option value="12" {{ old('tingkat') == '12' ? 'selected' : '' }}>XII (12)</option>
                                </select>
                                @error('tingkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jurusan --}}
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: MIPA / IPS / Rekayasa Perangkat Lunak" required>
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tahun Ajaran --}}
                            <div class="mb-3">
                                <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" placeholder="Contoh: 2026/2027" required>
                                @error('tahun_ajaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection