@extends('layouts.admin')

@section('header')
    <a class="nav-link fs-4 text-primary d-none d-lg-block" href="{{ route('siswa.index') }}">Data Siswa</a>
    <span class="nav-link fs-4 mx-2 d-none d-lg-block">/</span>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Detail Siswa</a>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Detail Siswa</h5>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('siswa.update', $siswa->nis) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">NIS</label>
                                        <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        @error('nis')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                                        <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="text" name="username" value="{{ old('username', $siswa->username) }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-warning w-100">Update</button>
                                </form>

                                <form action="{{ route('siswa.destroy', $siswa->nis) }}" method="POST">
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
@endsection
