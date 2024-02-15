@extends('layouts.admin')

@section('header')
    <a class="nav-link fs-4 text-primary d-none d-lg-block" href="{{ route('pelatih.index') }}">Data Pelatih</a>
    <span class="nav-link fs-4 mx-2 d-none d-lg-block">/</span>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Detail Pelatih</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Detail Pelatih</h5>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('pelatih.update', $pelatih->id_pelatih) }}" id="updateForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                                        <input type="text" name='nama' class="form-control" id="exampleInputEmail1"
                                            value="{{ old('nama', $pelatih->nama) }}" aria-describedby="emailHelp">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                            value="{{ old('username', $pelatih->username) }}" aria-describedby="emailHelp">
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                            <button class="btn btn-outline-primary" type="button" id="togglePassword">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Jenis Pelatih</label>
                                        <input type="text" name="jenis_pelatih" class="form-control" id="exampleInputEmail1"
                                            value="{{ old('jenis_pelatih', $pelatih->jenis_pelatih) }}" aria-describedby="emailHelp">
                                        <div id="jenis_pelatihHelp" class="form-text">
                                            Masukkan Jenis Pelatih: (PelatihFutsal, Pelatih Tari, atau lainnya)
                                        </div>
                                        @error('jenis_pelatih')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-warning w-100">Update</button>
                                </form>
                                

                                <form action="{{ route('pelatih.destroy', $pelatih->id_pelatih) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2 w-100">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
