@extends('layouts.main')

@section('title', 'Input Nilai Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Input Nilai Siswa</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('nilai.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="siswa_id" class="form-label">Pilih Siswa</label>
                                <select class="form-select @error('siswa_id') is-invalid @enderror" id="siswa_id" name="siswa_id" required>
                                    <option value="" disabled selected>-- Pilih Siswa --</option>
                                    @foreach ($siswa as $siswa)
                                        <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                            {{ $siswa->nama_lengkap }} ({{ $siswa->nis ?? 'NIS Tidak Ada' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mapel_id" class="form-label">Pilih Mata Pelajaran</label>
                                <select class="form-select @error('mapel_id') is-invalid @enderror" id="mapel_id" name="mapel_id" required>
                                    <option value="" disabled selected>-- Pilih Mata Pelajaran --</option>
                                    @foreach ($mapel as $mapel)
                                        <option value="{{ $mapel->id }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                            {{ $mapel->nama_mapel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mapel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nilai_tugas" class="form-label">Nilai Tugas</label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control @error('nilai_tugas') is-invalid @enderror" id="nilai_tugas" name="nilai_tugas" value="{{ old('nilai_tugas') }}" placeholder="Contoh: 85" required>
                                @error('nilai_tugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nilai_uts" class="form-label">Nilai UTS</label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control @error('nilai_uts') is-invalid @enderror" id="nilai_uts" name="nilai_uts" value="{{ old('nilai_uts') }}" placeholder="Contoh: 80" required>
                                @error('nilai_uts')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nilai_uas" class="form-label">Nilai UAS</label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control @error('nilai_uas') is-invalid @enderror" id="nilai_uas" name="nilai_uas" value="{{ old('nilai_uas') }}" placeholder="Contoh: 90" required>
                                @error('nilai_uas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection