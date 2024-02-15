@extends('layouts.admin')

@section('header')
    <a class="nav-link fs-4 text-primary d-none d-lg-block" href="{{ route('pertemuan.index') }}">Data Pertemuan</a>
    <span class="nav-link fs-4 mx-2 d-none d-lg-block">/</span>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Tambah Pertemuan</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Tambah Pertemuan</h5>
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form action="{{ route('pertemuan.store') }}" method="POST">
                                    @csrf
                
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="judul_pertemuan" class="form-label">Judul Pertemuan</label>
                                            <input type="text" name='judul_pertemuan' class="form-control"
                                                id="judul_pertemuan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Kegiatan *</label>
                                            <textarea class="form-control" rows="3" placeholder="" name="kegiatan" required></textarea>
                                            <div id="" class="form-text">Masukkan Penjelasan Kegiatan.</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Absen Mulai *</label>
                                                <input type="text" class="form-control" name="start_time" aria-describedby=""
                                                    required >
                                                <div id="" class="form-text">Masukan dengan format 24:00.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label"> Absen Selesai*</label>
                                                <input type="text" class="form-control" name="end_time" aria-describedby=""
                                                    required>
                                                <div id="" class="form-text">Masukan dengan format 24:00.</div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
