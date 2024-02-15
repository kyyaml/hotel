@extends('layouts.admin')

@section('header')
    <a class="nav-link fs-4 text-primary d-none d-lg-block" href="{{ route('pelatih.index') }}">Data Pelatih</a>
    <span class="nav-link fs-4 mx-2 d-none d-lg-block">/</span>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Tambah Pelatih</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Tambah Pelatih</h5>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('pelatih.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name='nama' class="form-control" id="nama"
                                            aria-describedby="namaHelp" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                            aria-describedby="usernameHelp" value="{{ old('username') }}">
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputPassword1">
                                            <button class="btn btn-outline-primary" type="button" id="togglePassword">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_pelatih" class="form-label">Jenis Pelatih</label>
                                        <input type="text" name="jenis_pelatih" class="form-control" id="jenis_pelatih"
                                            aria-describedby="jenis_pelatihHelp" value="{{ old('jenis_pelatih') }}">
                                        <div id="jenis_pelatihHelp" class="form-text">Masukkan Jenis Pelatih: (Pelatih
                                            Futsal, Pelatih Tari, atau lainnya)</div>
                                        @error('jenis_pelatih')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
