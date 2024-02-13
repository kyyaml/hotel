@extends('layouts.admin')

@section('header')
  <a class="nav-link fs-4 text-primary d-none d-lg-block" href="{{ route('pertemuan.index') }}">Data Pertemuan</a>
  <span class="nav-link fs-4 mx-2 d-none d-lg-block">/</span>
  <a href="#" class="nav-link fs-4 d-none d-lg-block">Tambah Pertemuan</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Tambah Pertemuan</h5>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('pertemuan.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="judul_pertemuan" class="form-label">Judul Pertemuan</label>
                                        <input type="text" name='judul_pertemuan' class="form-control" id="judul_pertemuan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kegiatan" class="form-label">Kegiatan</label>
                                        <input type="text" name="kegiatan" class="form-control" id="kegiatan" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tgl" class="form-label">Tanggal Pertemuan</label>
                                        <input type="date" name="tgl_pertemuan" class="form-control" placeholder="Tentukan tanggal">
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
