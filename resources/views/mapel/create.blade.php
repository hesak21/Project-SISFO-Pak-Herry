@extends('layouts.main')

@section('title', 'Tambah Data Mata Pelajaran')

@section('content')
    <div class="container-fluid">
        {{-- TODO: Buatlah form tambah data mata pelajaran (input: Kode Mapel, Nama Mapel, dan Nilai KKM) --}}

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Mata
                Pelajaran</h1>
            <a href="{{ route('mapel.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                <ul class="mb-0 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('mapel.store') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kode_mapel">Kode Mapel <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_mapel') is-invalid @enderror"
                                id="kode_mapel" name="kode_mapel" value="{{ old('kode_mapel') }}"
                                placeholder="Contoh: MP-PWPB" required>
                            @error('kode_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="kkm">Nilai KKM <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('kkm') is-invalid @enderror" id="kkm"
                                name="kkm" value="{{ old('kkm', 75) }}" min="0" max="100"
                                placeholder="Contoh: 75" required>
                            @error('kkm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_mapel">Nama Mapel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_mapel') is-invalid @enderror" id="nama_mapel"
                            name="nama_mapel" value="{{ old('nama_mapel') }}"
                            placeholder="Contoh: Pemrograman Web & Perangkat Bergerak" required>
                        @error('nama_mapel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                    <a href="{{ route('mapel.index') }}" class="btn btn-light border">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection